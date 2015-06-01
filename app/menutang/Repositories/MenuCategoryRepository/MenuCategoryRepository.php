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


use Illuminate\Support\Facades\Cache;
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
     * @param $id
     * @return mixed
     */
    public function getCategoryByBusinessId($id){
        $key = md5('getCategoryByBusinessId'.$id);
        if ($this->cache->has($key)) {
            return $this->cache->get($key);
        }
        $categoryByBuId =$this->model->wherehas('menuItem',function($query) use($id) {
            $query->where('business_info_id', '=',(int)$id);
        })->select('category_name','id')->orderBy('category_name')->get();
        $this->cache->put($key, $categoryByBuId);
        return $categoryByBuId;
    }
    /**
     * @param $businessId
     * @return mixed
     */
    public function findByProfile($businessId)
    {
        $key = md5('buProfile'.$businessId);
        if ($this->cache->has($key)) {
            return $this->cache->get($key);
        }
        $profileDetails =$this->model->wherehas('menuItem',function($query) use($businessId) {
              $query->where('business_info_id', '=',(int)$businessId);
        })->with(['menuItem'=>function($query) use($businessId) {
                $query->with('itemAddon')
                     ->with('weekDays')
                     ->with('optionItem')
                     ->where('business_info_id', '=',(int)$businessId);
            }])
            ->orderBy('category_name')->get();
        $this->cache->put($key, $profileDetails);
        return $profileDetails;
    }



}