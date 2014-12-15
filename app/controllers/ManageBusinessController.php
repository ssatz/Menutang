<?php
/*
 * This file is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Services\BusinessManager;


class ManageBusinessController extends BaseController
{

    protected $manage;

    function __construct(BusinessManager $manage)
    {
        $this->manage = $manage;
    }


    public function showBusinesses()
    {
        $data = $this->manage->getAllBusiness();
        return View::make('admin.manage_business')->withBusiness($data);
    }

    public function editBusinessInfo($slug)
    {
        $businessInfo = $this->manage->editBusiness($slug);
        if (empty($businessInfo)) {
            return '404';
        }

        return View::make('admin.edit_business');
    }

    public function addRestaurants()
    {
        return 'sathish';
    }

}