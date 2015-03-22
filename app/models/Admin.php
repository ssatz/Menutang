<?php

/*
 * This file is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\UserTrait;

class Admin extends Eloquent implements UserInterface, RemindableInterface
{
    use UserTrait, RemindableTrait;
    /**
     * @var string
     * table= 'admins'
     */
    protected $table = 'admins';
    /**
     * @var array
     */
    protected $fillable =['email,mobile,password'];
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password');

}