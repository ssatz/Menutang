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

    /**
     * @param DeliveryAddress $deliveryAddress
     * @param ICacheService $cache
     */
    public function __construct(DeliveryAddress $deliveryAddress, ICacheService $cache)
    {
        $cache->tag(get_class($deliveryAddress));
        parent::__construct($deliveryAddress, $cache);

    }

    /**
     * @param $userId
     * @param $deliveryId
     */
    public function makeDefault($userId, $deliveryId)
    {
       $this->model->where('user_id','=',$userId)->where('id','!=',$deliveryId)->update(['active'=>false]);
    }

    /**
     * @param $userId
     * @param $deliveryId
     */
    public function profileRemoveAddress($userId,$deliveryId){
        $this->model->where('user_id','=',$userId)->where('id','=',$deliveryId)->delete();
    }
}