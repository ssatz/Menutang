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
        return $this->model->with('itemAddon')->where('business_info_id','=',$buID->id)->where('menu_category_id','=',$categoryId)->get();
    }
    /**
     * @param array $data
     * @param $slug
     */
    public function insertOrUpdate(array $data, $slug)
    {
        if(isset($data['item'])) {
            $menuCategory = $data['menu_category'];
            $menuDelete = ltrim($data['menu_delete'], ',');
            $addonDelete = ltrim($data['addon_delete'], ',');
            $this->itemAddon->destroy($addonDelete);
            $this->model->destroy($menuDelete);
            $buId = $this->businessInfo->slug($slug)->first()->id;
            foreach ($data['item'] as $item) {
                $menuItem = $this->model->find($item['id']);
                if (is_null($menuItem)) {
                    $menuItem = new $this->model;
                }
                $menuItem->menu_category_id = $menuCategory;
                $menuItem->business_info_id = $buId;
                $menuItem->item_name = $item['item_name'];
                $menuItem->item_description = $item['item_description'];
                $menuItem->item_price = $item['item_price'];
                $menuItem->is_veg = $this->arrayExists('is_veg', $item) ? true : false;
                $menuItem->is_non_veg = $this->arrayExists('is_non_veg', $item) ? true : false;
                $menuItem->is_egg = $this->arrayExists('is_egg', $item) ? true : false;
                $menuItem->is_spicy = $this->arrayExists('is_spicy', $item) ? true : false;
                $menuItem->is_popular = $this->arrayExists('is_popular', $item) ? true : false;
                $menuItem->item_status = $this->arrayExists('item_status', $item) ? true : false;
                $menuItem->save();
                $numerickeys = array_filter(array_keys($item), 'is_int');
                foreach ($numerickeys as $key) {
                    $addon = $this->itemAddon->find($item[$key]['id']);
                    if (is_null($addon)) {
                        $addon = new $this->itemAddon;
                    }
                    $addon->addon_description = $item[$key]['addon_description'];
                    $addon->addon_price = $item[$key]['addon_price'];
                    $addon->addon_status = $this->arrayExists('addon_status', $item[$key]) ? true : false;
                    $addon->menuItem()->associate($menuItem);
                    $addon->save();
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
                if ($item['available_breakfast'])
                {
                    foreach($businessHours as $hr)
                    {
                        if($hr['time_category_id']==1){
                            array_push($available,$hr['id']);
                        }
                    }

                }
                if ($item['available_lunch'])
                {
                    foreach($businessHours as $hr)
                    {
                        if($hr['time_category_id']==2){
                            array_push($available,$hr['id']);
                        }
                    }
                }
                if ($item['available_dinner'])
                {
                    foreach($businessHours as $hr)
                    {
                        if($hr['time_category_id']==3){
                            array_push($available,$hr['id']);
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

    public function withAddon($menuId)
    {
        return $this->model->with('itemAddon')->find($menuId);
    }

    /**
     * @param $key
     * @param array $input
     * @return bool
     */
    private function arrayExists($key, array $input)
    {
        return array_key_exists($key, $input);
    }
}