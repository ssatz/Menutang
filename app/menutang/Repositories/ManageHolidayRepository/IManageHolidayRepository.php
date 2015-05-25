<?php
/*
 * This file(IManageHolidayRepository.php) is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Repositories\ManageHolidayRepository;


interface IManageHolidayRepository {

    public function findHolidayByBUID($businessId);
    public function deleteById($holidayId);
}