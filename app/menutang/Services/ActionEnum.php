<?php
/*
 * This file(ActionEnum.php) is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Services;
use MyCLabs\Enum\Enum;

class ActionEnum extends Enum {
    const Minus ="Minus";
    const Add ="Add";
    const Delete="Delete";
    const UPDATE="UPDATE";
}