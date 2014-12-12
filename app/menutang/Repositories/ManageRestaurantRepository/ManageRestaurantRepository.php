<?php
/*
 * This file is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Repositories\ManageRestaurantRepository;


use Repositories\BaseRepository;
use RestaurantInfo;

class ManageRestaurantRepository extends BaseRepository implements IManageRestaurantRepository
{
    protected $manageRestaurants;

    function __construct(RestaurantInfo $manageRestaurants)
    {
        $this->manageRestaurants = $manageRestaurants;
    }


    /**
     * @param array $data
     */
    public function create(array $data)
    {

    }

    /**
     * @param $name
     * @return mixed
     */
    public function findbyRestaurantName($name)
    {
        return $this->manageRestaurants->where('restaurant_name', 'LIKE', '%' . $name . '%')
            ->with('businessUser', 'business', 'payment')
            ->paginate(15);
    }

    /**
     * @param $userId
     * @return mixed
     */
    public function findbyRestaurantUserId($userId)
    {
        return $this->manageRestaurants->where('business_users_id', '=', $userId)
            ->with('businessUser', 'business', 'payment')
            ->paginate(15);
    }

    /**
     * @param $email
     * @return mixed
     */
    public function findbyRestaurantUserEmail($email)
    {
        return $this->manageRestaurants->where('id', '=', $email)
            ->with('businessUser', 'business', 'payment')
            ->paginate(15);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findbyRestaurantId($id)
    {
        return $this->manageRestaurants->where('id', '=', $id)
            ->with('businessUser', 'business', 'payment')
            ->paginate(15);
    }

    /**
     * @return mixed
     */
    public function getAllRestaurants()
    {
        return $this->manageRestaurants->with('businessUser', 'business', 'payment')->paginate(15);
    }
}