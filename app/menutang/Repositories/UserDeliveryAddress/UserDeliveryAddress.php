<?php
/*
 * This file(UserDeliveryAddress.php) is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Repositories\UserDeliveryAddress;

use Repositories\BaseRepository;
use UserDeliveryAddress as DeliveryAddress;
use Services\Cache\ICacheService;

class UserDeliveryAddress extends BaseRepository implements IUserDeliveryAddress {

    public function __construct(DeliveryAddress $deliveryAddress, ICacheService $cache)
    {
        $cache->tag(get_class($deliveryAddress));
        parent::__construct($deliveryAddress, $cache);

    }

}