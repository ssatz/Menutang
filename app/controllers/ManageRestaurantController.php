<?php
/*
 * This file is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Repositories\ManageRestaurantRepository\ManageRestaurantRepository;

class ManageRestaurantController extends BaseController{

    protected $manage;

    function __construct(ManageRestaurantRepository $manage)
    {
        $this->manage = $manage;
    }


    public  function showRestaurants()
    {
       // return $this->manage->findbyRestaurantId(2);
        return View::make('admin.manage_restaurant');
    }

    public function addRestaurants()
    {
        return 'sathish';
    }

}