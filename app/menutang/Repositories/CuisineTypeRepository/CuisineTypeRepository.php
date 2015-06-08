<?php
/*
 * This file(CuisineTypeRepository.php) is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Repositories\CuisineTypeRepository;


use Repositories\BaseRepository;
use CuisineType;
use Services\Cache\ICacheService;
use Services\StatusEnum;
use Illuminate\Support\Facades\DB;

class CuisineTypeRepository extends BaseRepository implements ICuisineTypeRepository {


    /**
     * @param CuisineType $cuisineType
     * @param ICacheService $cache
     */
    public function __construct(CuisineType $cuisineType, ICacheService $cache)
    {
        $cache->tag(get_class($cuisineType));
        parent::__construct($cuisineType, $cache);

    }
    public function getAllCuisineWithBusiness()
    {
        $key = md5(__METHOD__);
        if ($this->cache->has($key)) {
            return $this->cache->get($key);
        }
        $city = $this->model->join('business_cuisine','cuisine_type.id','=','business_cuisine.cuisine_type_id')
            ->join('business_info','business_cuisine.business_info_id','=','business_info.id')
            ->where('business_info.status_id','=',StatusEnum::ACTIVE)
            ->select(DB::raw('count(*) as count,cuisine_type.cuisine_description'))->groupBy('cuisine_type.id')->get();
        $this->cache->put($key, $city);
        return $city;
    }
}