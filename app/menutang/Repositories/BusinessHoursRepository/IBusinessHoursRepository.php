<?php
/*
 * This file(IBusinessHoursRepository.php) is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Repositories\BusinessHoursRepository;


interface IBusinessHoursRepository {
 public function findTimeByBU($buId);
}