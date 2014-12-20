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
        parent::__construct($manageCity, $cache);
    }

}