<?php
/*
 * This file is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Repositories\MenuCategoryRepository;


use Repositories\BaseRepository;
use Services\Cache\ICacheService;
use MenuCategory;

class MenuCategoryRepository extends BaseRepository implements IMenuCategoryRepository
{
    /**
     * @param City $manageCity
     */
    public function __construct(MenuCategory $menuCategory, ICacheService $cache)
    {
        $cache->tag(get_class($menuCategory));
        parent::__construct($menuCategory, $cache);
    }

    /**
     * Return all last item
     * @return json
     */
    public function getLastInsertedItem()
    {
        return $this->model->orderBy('created_at', 'DESC')->first();
    }

    /**
     * @param $categoryName
     * @return mixed
     */
    public function findOrCreate($categoryName)
    {
        $category= $this->model->where('category_name','=',$categoryName)->first();
        if(is_null($category))
        {
            $category = new $this->model;
            $category->category_name = $categoryName;
            $category->save();
        }
        return $category->id;
    }

    /**
     * @param $businessId
     * @return mixed
     */
    public function findByProfile($businessId)
    {
        $profileDetails =$this->model->wherehas('menuItem',function($query) use($businessId) {
            $query->where('business_info_id', '=', $businessId);
        })->with('menuItem.businessHours')->with('menuItem.itemAddon')->with('menuItem.weekDays')->get();
        return $profileDetails;
    }



}