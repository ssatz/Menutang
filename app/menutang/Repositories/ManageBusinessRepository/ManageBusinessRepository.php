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


use BusinessInfo;
use Illuminate\Database\DatabaseManager;
use Repositories\BaseRepository;


class ManageBusinessRepository extends BaseRepository implements IManageBusinessRepository
{
    /**
     * @var businessInfo
     */
    protected $manageBusiness;

    /**
     * @var DatabaseManager
     */
    protected $dbManager;

    /**
     * @param businessInfo $managebusinesss
     * @param DatabaseManager $dbManager
     */
    function __construct(BusinessInfo $manageBusiness, DatabaseManager $dbManager)
    {
        $this->manageBusiness = $manageBusiness;
        $this->dbManager = $dbManager;

    }

    /**
     * @param $name
     * @return mixed
     */
    public function findbyRestaurantName($name)
    {
        // TODO: Implement findbyRestaurantName() method.
    }

    /**
     * @param $userId
     * @return mixed
     */
    public function findbyRestaurantUserId($userId)
    {
        // TODO: Implement findbyRestaurantUserId() method.
    }

    /**
     * @param $email
     * @return mixed
     */
    public function findbyRestaurantUserEmail($email)
    {
        // TODO: Implement findbyRestaurantUserEmail() method.
    }

    /**
     * @return mixed
     */
    public function getAllRestaurants()
    {
        return $this->dbManager->table('business_info')
            ->leftjoin('business_address', 'business_info.id', '=', 'business_address.business_id')
            ->leftjoin('business_users', 'business_info.id', '=', 'business_users.id')
            ->paginate(15);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findbyRestaurantId($id)
    {
        // TODO: Implement findbyRestaurantId() method.
    }
}