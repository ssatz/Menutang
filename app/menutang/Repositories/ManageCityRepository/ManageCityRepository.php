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
use Repositories\BaseRepository;
use Services\Cache\ICacheService;

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
            $this->model->create($input);
        }
        return;
    }

}