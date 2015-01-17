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


use Repositories\BaseRepository;
use MenuItem;
use Services\Cache\ICacheService;
use BusinessInfo;
use ItemAddon;

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
     * @param MenuItem $menuItem
     * @param ICacheService $cache
     * @param BusinessInfo $buInfo
     * @param ItemAddon $itemAddon
     */
    public function __construct(MenuItem $menuItem, ICacheService $cache, BusinessInfo $buInfo, ItemAddon $itemAddon)
    {
        parent::__construct($menuItem, $cache);
        $this->businessInfo = $buInfo;
        $this->itemAddon = $itemAddon;
    }

    /**
     * @param array $data
     * @param $slug
     */
    public function insert(array $data, $slug)
    {
        $menuCategory = $data['menu_category'];
        $buId = $this->businessInfo->slug($slug)->first()->id;
        foreach ($data['item'] as $item) {
            $menuItem = new $this->model;
            $menuItem->menu_category_id = $menuCategory;
            $menuItem->business_info_id = $buId;
            $menuItem->item_name = $item['item_name'];
            $menuItem->item_description = $item['item_description'];
            $menuItem->item_price = $item['item_price'];
            $menuItem->is_veg = $this->arrayExists('is_veg', $item);
            $menuItem->is_non_veg = $this->arrayExists('is_non_veg', $item);
            $menuItem->is_egg = $this->arrayExists('is_egg', $item);
            $menuItem->is_spicy = $this->arrayExists('is_spicy', $item);
            $menuItem->is_popular = $this->arrayExists('is_popular', $item);
            $menuItem->save();
            $numerickeys = array_filter(array_keys($item), 'is_int');
            foreach ($numerickeys as $key) {
                $addon = new $this->itemAddon;
                $addon->addon_description = $item[$key]['addon_description'];
                $addon->addon_price = $item[$key]['addon_price'];
                $addon->addon_status = $this->arrayExists('addon_status', $item[$key]);
                $addon->menuItem()->associate($menuItem);
                $addon->save();
            }

        }

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