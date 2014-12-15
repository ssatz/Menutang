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
     * @return mixed
     */
    public function getAllBusiness();

    /**
     * @return mixed
     */
    public function totalBusinesscount();

    public function findBusinessBySlug($slug);
}