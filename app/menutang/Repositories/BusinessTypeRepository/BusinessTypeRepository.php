<?php
/*
 * This file(BusinessTypeRepository.php) is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Repositories\BusinessTypeRepository;


use Repositories\BaseRepository;
use BusinessType;
use Services\Cache\ICacheService;

class BusinessTypeRepository extends BaseRepository implements IBusinessTypeRepository
{
    /**
     * @param BusinessUser $businessUser
     */
    public function __construct(BusinessType $buType, ICacheService $cache)
    {
        $cache->tag(get_class($buType));
        parent::__construct($buType, $cache);

    }

    /**
     * @return mixed
     */
    public function getAllTypes()
    {
        $key = md5(__METHOD__);
        if ($this->cache->has($key)) {
            return $this->cache->get($key);
        }
        $types=$this->model->leftjoin('cuisine_type','cuisine_type.business_type_id','=','business_type.id')->get();
        $this->cache->put($key, $types);
        return $types;
    }

    public function getBUTypeWithCuisineType()
    {
       return $this->model->with('cuisineType')->get();
    }
}