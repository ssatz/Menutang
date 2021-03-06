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
        $cache->tag(get_class($deliveryArea));
        parent::__construct($deliveryArea, $cache);
    }


    /**
     * @param $pagination
     * @return mixed
     */
    public function  getAllPaginate($pagination)
    {
        return $this->model->with('city')->paginate($pagination);
    }

    /**
     * @param $area
     * @return mixed
     */
    public function searchDeliveryArea($area)
    {
        return $this->model->where('area', 'LIKE', '%'.$area.'%')->select('id','area','area_pincode','city_id')->get();
    }

    /**
     * @param $cityId
     * @return mixed
     */
    public function findByCity($cityId)
    {
        return $this->model->where('city_id','=',(int)$cityId)->select('id','area')->get();
    }
}