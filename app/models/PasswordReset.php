<?php

/*
 * This file is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class PasswordReset extends Eloquent
{
    protected $table = 'password_reset';

    public function user()
    {
        return $this->belongsTo('User');
    }
}