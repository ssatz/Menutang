<?php
/*
 * This file is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Repositories\RestaurantRepository;


use Repositories\BaseRepository;
use Admin;

class  RestaurantRepository extends BaseRepository implements IRestaurantRepository
{
    protected $restaurant;

    public function __construct(Resta $restaurant)
    {
        parent::__construct($admin);
        $this->admin = $admin;
    }

    public function create(array $data)
    {
        return $this->admin->create($data);
    }

    public function findOrFail($id)
    {
        return $this->admin->findOrFail($id);
    }
}