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

use Repositories\ManageRestaurantRepository\IManageRestaurantRepository;
use Services\Cache\ICacheService;


class RestaurantManager
{

    /**
     * @var IManageRestaurantRepository
     */
    protected $manageRestaurant;

    /**
     * @var ICacheService
     */
    protected $cacheService;

    public function __construct(IManageRestaurantRepository $manageRestaurant, ICacheService $cacheService)
    {
        $this->manageRestaurant = $manageRestaurant;
        $this->cacheService = $cacheService;
    }

    /**
     * @return mixed
     */
    public function getAllRestaurants()
    {
        $key = __METHOD__;
        if ($this->cacheService->has($key))
        {
            return $this->cache->get($key);
        }

        $restaurants = $this->manageRestaurant->getAllRestaurants();

        $this->cache->put($key, $restaurants);

        return $restaurants;
    }

}