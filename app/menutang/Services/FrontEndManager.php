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
use Repositories\ManageDeliveryAreaRepository\IManageDeliveryAreaRepository;
use Repositories\ManageCityRepository\IManageCityRepository;
use Repositories\CuisineTypeRepository\ICuisineTypeRepository;
use Illuminate\Foundation\Application;


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
     * @var IManageDeliveryAreaRepository
     */
    protected $deliveryArea;
    /**
     * @var IManageCityRepository
     */
    protected $cityRepo;
    protected $cuisineRepo;
    /**
     * @var Application
     */
    protected $app;

    /**
     * @param IManageBusinessRepository $buManager
     * @param IMenuCategoryRepository $menuCategoryRepository
     * @param IBusinessTypeRepository $businessTypeRepository
     */
    public function __construct(IManageBusinessRepository $buManager,
                                IMenuCategoryRepository $menuCategoryRepository,
                                IManageDeliveryAreaRepository $deliveryArea,
                                IManageCityRepository   $cityRepository  ,
                                ICuisineTypeRepository $cuisineTypeRepository,
                                Application $application,
                                IBusinessTypeRepository $businessTypeRepository)
    {
        $this->buManager = $buManager;
        $this->menuCategory = $menuCategoryRepository;
        $this->businessType = $businessTypeRepository;
        $this->deliveryArea = $deliveryArea;
        $this->cityRepo = $cityRepository;
        $this->cuisineRepo=$cuisineTypeRepository;
        $this->app=$application;
    }

    /**
     * @param $locality
     * @param null $area
     * @return mixed
     */
    public function searchQuery($locality,$area=null,$business,$serviceType,$cuisineType,$paymentType)
    {
        if(is_null($area))
        {
            return $this->buManager->findByLocality($locality,$business,$serviceType,$cuisineType,$paymentType);
        }
        return $this->buManager->findByArea($locality,$area,$business,$serviceType,$cuisineType,$paymentType);
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
        if(is_null($bu)){
            $this->app->abort(404);
        }
        $profile = $this->getProfileDetails($bu->id);
        $cityArea = $this->deliveryArea->findByCity($bu->address->city->id);
        $menuCategory =array_unique($profile->lists('category_name'));
        return [$bu,$profile,$menuCategory,$cityArea];
    }

    /**
     * @return mixed
     */
    public function getAllBusinessTypes()
    {
        return $this->businessType->getAllTypes();
    }

    /**
     * @return mixed
     */
    public function getAllCuisinesWithBusinessCount()
    {
        return $this->cuisineRepo->getAllCuisineWithBusiness();
    }

    /**
     * @return mixed
     */
    public function getAvailableCities(){
        return $this->cityRepo->getAllCityWithBusiness();
    }
}