<?php
/*
 * This file is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Repositories\ManageCountryRepository;


use Country;
use Repositories\BaseRepository;
use Services\Cache\ICacheService;

class ManageCountryRepository extends BaseRepository implements IManageCountryRepository
{


    /**
     * @param Country $manageCountry
     * @param ICacheService $cache
     */
    public function __construct(Country $manageCountry, ICacheService $cache)
    {
        $cache->tag(get_class($manageCountry));
        parent::__construct($manageCountry, $cache);
    }

    /**
     * To Load the Nested Relationship
     * @return mixed
     */
    public function getCity()
    {
        return $this->model->with('city.state')->get();
    }
}