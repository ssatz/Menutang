<?php
/*
 * This file(SpeedEnum.php) is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Services;


use MyCLabs\Enum\Enum;

class SpeedEnum extends Enum {
    const FAST = '45';
    const MEDIUM = '45-60';
    const SLOW = '60>';

}