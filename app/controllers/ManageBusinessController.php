<?php
/*
 * This file is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Services\RestaurantManager;

class ManageBusinessController extends BaseController{

    protected $manage;

    function __construct(RestaurantManager $manage)
    {
        $this->manage = $manage;
    }


    public  function showRestaurants()
    {
       // return $this->manage->getAllRestaurants();
        return View::make('admin.manage_restaurant');
    }

    public function addRestaurants()
    {
        return 'sathish';
    }

}