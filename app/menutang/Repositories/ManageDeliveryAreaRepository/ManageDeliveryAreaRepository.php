<?php
/*
 * This file is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Repositories\ManageDeliveryAreaRepository;


use DeliveryArea;
use Repositories\BaseRepository;

class ManageDeliveryAreaRepository extends BaseRepository implements IManagerDeliveryAreaRepository
{
    public function __construct(DeliveryArea $deliveryArea)
    {
        parent::__construct($deliveryArea);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findByBusiness($id)
    {
        // TODO: Implement findByBusiness() method.
    }
}