<?php
/*
 * This file is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Repositories\ManageCityRepository;


use City;
use Illuminate\Support\Facades\Cache;
use Repositories\BaseRepository;
use Services\Cache\ICacheService;
use Illuminate\Support\Facades\DB;
use Services\StatusEnum;

class ManageCityRepository extends BaseRepository implements IManageCityRepository
{


    /**
     * @param City $manageCity
     */
    public function __construct(City $manageCity, ICacheService $cache)
    {
        $cache->tag(get_class($manageCity));
        parent::__construct($manageCity, $cache);
    }

    /**
     * @return mixed
     */
    public function getCityWithState()
    {
        $key = md5($this->getObjectName() . '.State');
        if ($this->cache->has($key)) {
            return $this->cache->get($key);
        }
        $stateRelation = $this->model->with('state.country')->get();
        $this->cache->put($key, $stateRelation);
        return $stateRelation;
    }

    public function create(array $input)
    {
        $key = md5($this->getObjectName() . '.State');
        if ($this->cache->has($key)) {
            $this->cache->remove($key);
        }
        $this->model->create($input);
        return;
    }

    public function getAllCityWithBusiness()
    {
        $key = md5(__METHOD__);
        if ($this->cache->has($key)) {
            return $this->cache->get($key);
        }
        $city = $this->model->join('business_address','city.id','=','business_address.city_id')
                            ->join('business_info','business_address.business_info_id','=','business_info.id')
                            ->where('business_info.status_id','=',StatusEnum::ACTIVE)
                            ->select(DB::raw('count(*) as count,city.city_description'))->groupBy('city_id')->get();
        $this->cache->put($key, $city);
        return $city;
    }
}