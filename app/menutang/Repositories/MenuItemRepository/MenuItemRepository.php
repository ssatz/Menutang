<?php
/*
 * This file(MenuItemRepository.php) is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Repositories\MenuItemRepository;


use Illuminate\Support\Collection;
use Repositories\BaseRepository;
use MenuItem;
use Services\Cache\ICacheService;
use BusinessInfo;
use ItemAddon;
use Exception;
use BusinessHours;
use Services\Helper;
use Services\TimeCategoryEnum;

class MenuItemRepository extends BaseRepository implements IMenuItemRepository
{

    /**
     * @var BusinessInfo
     */
    protected $businessInfo;
    /**
     * @var ItemAddon
     */
    protected $itemAddon;

    /**
     * @var Helper
     */
    protected $helper;

    /**
     * @param MenuItem $menuItem
     * @param ICacheService $cache
     * @param BusinessInfo $buInfo
     * @param ItemAddon $itemAddon
     */
    public function __construct(MenuItem $menuItem,
                                ICacheService $cache,
                                BusinessInfo $buInfo,
                                Helper $helper,
                                ItemAddon $itemAddon)
    {
        $cache->tag(get_class($menuItem));
        parent::__construct($menuItem, $cache);
        $this->businessInfo = $buInfo;
        $this->itemAddon = $itemAddon;
        $this->helper = $helper;
    }


    /**
     * @param $slug
     * @return mixed
     */
    public function getMenuItemAddon($slug,$categoryId)
    {
        $buID = BusinessInfo::Where('business_slug','=',$slug)->select('id')->first();
        return $this->model->with('itemAddon','businessHours','weekDays')->where('business_info_id','=',$buID->id)->where('menu_category_id','=',$categoryId)->get();
    }
    /**
     * @param array $data
     * @param $slug
     */
    public function insertOrUpdate(array $data, $slug)
    {
        $menuCategory = $data['menu_category'];
        $menuDelete =explode(',',ltrim($data['menu_delete'], ','));
        $addonDelete = explode(',',ltrim($data['addon_delete'], ','));
        $this->itemAddon->destroy(array_map('intval', $addonDelete));
        $this->model->destroy(array_map('intval', $menuDelete));
        $buId = $this->businessInfo->slug($slug)->first()->id;
            if (isset($data['item'])) {
                $id = null;
                    foreach ($data['item'] as $key => $item) {
                        if (isset($item['menu_id']))
                        {
                        $menuItem = $this->model->find($item['menu_id']);
                        if (is_null($menuItem)) {
                            $menuItem = new $this->model;
                        }
                        $menuItem->menu_category_id = $menuCategory;
                        $menuItem->business_info_id = $buId;
                        $menuItem->item_name = $item['item_name'];
                        $menuItem->item_description = $item['item_description'];
                        $menuItem->item_price = $item['item_price'];
                        $menuItem->is_veg = isset($item['is_veg']) ? true : false;
                        $menuItem->is_non_veg = isset($item['is_non_veg']) ? true : false;
                        $menuItem->is_egg = isset($item['is_egg']) ? true : false;
                        $menuItem->is_spicy = isset($item['is_spicy']) ? true : false;
                        $menuItem->is_popular = isset($item['is_popular']) ? true : false;
                        $menuItem->item_status = isset($item['item_status']) ? true : false;
                        $menuItem->is_eggless = isset($item['is_eggless']) ? true : false;
                        $menuItem->is_pickup = isset($item['is_pickup']) ? true : false;
                        $menuItem->is_delivery = isset($item['is_delivery']) ? true : false;
                        $menuItem->save();
                        $numerickeys = array_filter(array_keys($item), 'is_int');
                        foreach ($numerickeys as $key) {
                            $addon = $this->itemAddon->find($item[$key]['addon_id']);
                            if (is_null($addon)) {
                                $addon = new $this->itemAddon;
                            }
                            $addon->addon_description = $item[$key]['addon_description'];
                            $addon->addon_price = $item[$key]['addon_price'];
                            $addon->addon_status = isset($item[$key]['addon_status']) ? true : false;
                            $addon->menuItem()->associate($menuItem);
                            $addon->save();
                        }
                        if (isset($item['time_category'])) {
                            $menuItem->businessHours()->sync($item['time_category']);
                        }
                        if (isset($item['weekdays'])) {
                            $menuItem->weekDays()->sync($item['weekdays']);
                        }
                    }
                }
            }
    }

    /**
     * @param $data
     * @throws Exception
     */
    public function bulkInsert($data,$buId)
    {
        $this->cache->flushAll();
        if(!$data instanceof Collection)
            throw new Exception("Must be a Collection");

        $businessHours = BusinessHours::where('business_info_id','=',$buId)
                                    ->select('id','time_category_id')
                                    ->get()
                                    ->toArray();
        foreach ($data as $menuItem)
        {
            foreach($menuItem as $item) {
                $available = [];
                if ($item['available_fullday'])
                {
                    foreach($businessHours as $hr)
                    {
                        if($hr['time_category_id']==TimeCategoryEnum::FULLDAY){
                            array_push($available,$hr['id']);
                        }
                    }

                }
                else {
                    if ($item['available_breakfast']) {
                        foreach ($businessHours as $hr) {
                            if ($hr['time_category_id'] == TimeCategoryEnum::BREAKFAST) {
                                array_push($available, $hr['id']);
                            }
                        }

                    }
                    if ($item['available_lunch']) {
                        foreach ($businessHours as $hr) {
                            if ($hr['time_category_id'] == TimeCategoryEnum::LUNCH) {
                                array_push($available, $hr['id']);
                            }
                        }
                    }
                    if ($item['available_dinner']) {
                        foreach ($businessHours as $hr) {
                            if ($hr['time_category_id'] == TimeCategoryEnum::DINNER) {
                                array_push($available, $hr['id']);
                            }
                        }
                    }
                }
                $result = $this->helper->match($item,['menu_item']);
                $menu= $this->model->create($result['menu_item']);
                $menu->businessHours()->sync($available);
                foreach ($item['itemAddon'] as $addon)
                {
                    $addonItem = new $this->itemAddon($addon);
                    $addonItem->menuItem()->associate($menu);
                    $addonItem->save();
                }
            }
        }

    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * @param $menuId
     * @return mixed
     */
    public function withAddon($menuId)
    {
        return $this->model->with('itemAddon')->find($menuId);
    }

    public function deleteByBUID($businessID)
    {
       return $this->model->where('business_info_id','=',$businessID)->delete();
    }
}