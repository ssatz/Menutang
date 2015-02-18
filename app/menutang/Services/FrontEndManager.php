<?php
/*
 * This file(FrontEndManager.php) is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Services;

use Illuminate\Support\Collection;
use Repositories\ManageBusinessRepository\IManageBusinessRepository;
use Repositories\MenuCategoryRepository\IMenuCategoryRepository;


class FrontEndManager {

    protected  $buManager;

    protected  $menuCategory;
    function __construct(IManageBusinessRepository $buManager,IMenuCategoryRepository $menuCategoryRepository)
    {
        $this->buManager = $buManager;
        $this->menuCategory = $menuCategoryRepository;
    }

    public function searchQuery($query)
    {
       return $this->buManager->findBySearch($query);
    }

    public function getBusinessDetails($restaurantSlug)
    {
        return $this->buManager->findBusinessBySlug($restaurantSlug);
    }

    public  function getProfileDetails($businessID)
    {
        return $this->menuCategory->findByProfile($businessID);
    }

    public function restaurantProfile($restaurantSlug)
    {
        $bu = $this->getBusinessDetails($restaurantSlug);
        $profile = $this->getProfileDetails($bu->id);
        $menuCategory =array_unique($profile->lists('category_name'));
        return [$bu,$profile,$menuCategory];
    }
}