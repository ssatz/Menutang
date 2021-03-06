<?php
/*
 * This file(WeekDays.php) is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Services;
use ReflectionClass;


final class WeekDays
{
    /**
     * Monday
     */
    const MONDAY = 1;
    /**
     *
     */
    const TUESDAY = 2;
    /**
     *
     */
    const WEDNESDAY = 3;
    /**
     *
     */
    const THURSDAY = 4;
    /**
     *
     */
    const FRIDAY = 5;
    /**
     *
     */
    const SATURDAY = 6;

    /**
     * Sunday
     */
    const SUNDAY = 7;

    /**
     * @param $value
     * @return mixed
     */
    public static function getWeekDay($value)
    {
        $class = new ReflectionClass(__CLASS__);
        $constants = array_flip($class->getConstants());

        return $constants[$value];
    }
}