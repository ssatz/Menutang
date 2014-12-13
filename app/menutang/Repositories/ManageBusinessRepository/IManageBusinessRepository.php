<?php
/*
 * This file is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Repositories\ManageBusinessRepository;


interface IManageBusinessRepository
{
    /**
     * @param $id
     * @return mixed
     */
    public function findbyRestaurantId($id);

    /**
     * @param $name
     * @return mixed
     */
    public function findbyRestaurantName($name);

    /**
     * @param $userId
     * @return mixed
     */
    public function findbyRestaurantUserId($userId);

    /**
     * @param $email
     * @return mixed
     */
    public function findbyRestaurantUserEmail($email);

    /**
     * @return mixed
     */
    public function getAllRestaurants();

}