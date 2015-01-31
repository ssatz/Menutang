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
use Services\Cache\ICacheService;

class ManageDeliveryAreaRepository extends BaseRepository implements IManageDeliveryAreaRepository
{
    /**
     * @param DeliveryArea $deliveryArea
     * @param ICacheService $cache
     */
    public function __construct(DeliveryArea $deliveryArea, ICacheService $cache)
    {
        parent::__construct($deliveryArea, $cache);
    }


    /**
     * @param $pagination
     * @return mixed
     */
    public function  getAllPaginate($pagination)
    {
        return $this->model->paginate($pagination);
    }
}