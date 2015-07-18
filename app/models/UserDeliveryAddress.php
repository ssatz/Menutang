<?php
/*
 * This file(UserDeliveryAddress.php) is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class UserDeliveryAddress extends Eloquent {
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_delivery_address';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @return mixed
     */
    public function user()
    {
        return $this->hasOne('User');
    }
}