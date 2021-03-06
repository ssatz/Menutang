<?php

/*
 * This file is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class State extends Eloquent
{

    /**
     * @var string
     */
    protected $table = 'state';

    /**
     * @return mixed
     */
    public function city()
    {
        return $this->hasMany('City');
    }

    /**
     * @return mixed
     */
    public function country()
    {
        return $this->belongsTo('Country');
    }
}