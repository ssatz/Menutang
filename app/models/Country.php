<?php
/*
 * This file is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class Country extends Eloquent {

    /**
     * @var string
     */
    protected $table='country';

    /**
     * @return mixed
     */
    public function state()
    {
        return $this->hasMany('state');

    }

    /**
     * @return mixed
     */
    public function city()
    {
        return $this->hasMany('city');

    }
}