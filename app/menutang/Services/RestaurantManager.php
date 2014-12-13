<?php
/*
 * This file is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Services;

use Repositories\ManageBusinessRepository\IManageBusinessRepository;
use Services\Cache\ICacheService;


class RestaurantManager
{

    /**
     * @var IManageRestaurantRepository
     */
    protected $manageBusiness;

    /**
     * @var ICacheService
     */
    protected $cacheService;

    /**
     * @param IManageBusinessRepository $manageRestaurant
     * @param ICacheService $cacheService
     */
    public function __construct(IManageBusinessRepository $manageBusiness, ICacheService $cacheService)
    {
        $this->manageBusiness = $manageBusiness;
        $this->cacheService = $cacheService;
    }

    /**
     * @return mixed
     */
    public function getAllRestaurants()
    {
        $restaurants = $this->manageBusiness->getAllRestaurants();
        return $restaurants;
    }

}