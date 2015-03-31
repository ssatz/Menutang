<?php
/*
 * This file(Attribute.php) is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class Attribute extends Eloquent {
    /**
     * @var string
     */
    protected $table='attribute';
    /**
     * @var array
     */
    protected $guarded=[];

    /**
     * @return mixed
     */
    public function attributeGroup()
    {
        return $this->belongsTo('AttributeGroup');
    }
}