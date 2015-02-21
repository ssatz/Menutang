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


use Repositories\ManageBusinessRepository\IManageBusinessRepository;
use Repositories\MenuCategoryRepository\IMenuCategoryRepository;
use Repositories\BusinessTypeRepository\IBusinessTypeRepository;


class FrontEndManager {

    /**
     * @var IManageBusinessRepository
     */
    protected  $buManager;

    /**
     * @var IMenuCategoryRepository
     */
    protected  $menuCategory;

    /**
     * @var IBusinessTypeRepository
     */
    protected $businessType;

    /**
     * @param IManageBusinessRepository $buManager
     * @param IMenuCategoryRepository $menuCategoryRepository
     * @param IBusinessTypeRepository $businessTypeRepository
     */
    public function __construct(IManageBusinessRepository $buManager,
                                IMenuCategoryRepository $menuCategoryRepository,
                                IBusinessTypeRepository $businessTypeRepository)
    {
        $this->buManager = $buManager;
        $this->menuCategory = $menuCategoryRepository;
        $this->businessType = $businessTypeRepository;
    }

    /**
     * @param $query
     * @return \Repositories\ManageBusinessRepository\BusinessInfo
     */
    public function searchQuery($query)
    {

       return $this->buManager->findBySearch($query);
    }

    /**
     * @param $restaurantSlug
     * @return mixed
     */
    public function getBusinessDetails($restaurantSlug)
    {
        return $this->buManager->findBusinessBySlug($restaurantSlug);
    }

    /**
     * @param $businessID
     * @return mixed
     */
    public  function getProfileDetails($businessID)
    {
        return $this->menuCategory->findByProfile($businessID);
    }

    /**
     * @param $restaurantSlug
     * @return array
     */
    public function restaurantProfile($restaurantSlug)
    {
        $bu = $this->getBusinessDetails($restaurantSlug);
        $profile = $this->getProfileDetails($bu->id);
        $menuCategory =array_unique($profile->lists('category_name'));
        return [$bu,$profile,$menuCategory];
    }

    /**
     * @return mixed
     */
    public function getAllBusinessTypes()
    {
        return $this->businessType->getAllTypes();
    }
}