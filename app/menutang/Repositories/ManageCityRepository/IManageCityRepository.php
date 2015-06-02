<?php
/*
 * This file is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Repositories\ManageCityRepository;


interface IManageCityRepository
{
    public function getAll();
    public function create(array $input);
    public function getCityWithState();
    public function getAllCityWithBusiness();

}