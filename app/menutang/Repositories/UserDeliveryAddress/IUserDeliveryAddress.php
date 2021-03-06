<?php
/*
 * This file(IUserDeliveryAddress.php) is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Repositories\UserDeliveryAddress;


interface IUserDeliveryAddress {

    public function makeDefault($userId,$deliveryId);
    public function profileRemoveAddress($userId,$deliveryId);

}