<?php
/*
 * This file(TimeCategoryEnum.php) is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Services;
use MyCLabs\Enum\Enum;

class TimeCategoryEnum  extends Enum{

    const FULLDAY=1;

    /**
     * breakfast - should be equal to TimeCategory Table breakfast column
     */
    const BREAKFAST=2;
    /**
     * lunch - should be equal to TimeCategory Table Lunch column
     */
    const LUNCH=3;
    /**
     * Dinner - should be equal to TimeCategory Table Dinner column
     */
    const DINNER=4;
}