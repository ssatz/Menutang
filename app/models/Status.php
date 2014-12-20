<?php

/*
 * This file is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class Status extends Eloquent
{
    /**
     * @var string
     */
    protected $table = 'status';

    /**
     * @return mixed
     */
    public function businessInfo()
    {
        return $this->belongsTo('BusinessInfo');
    }
}