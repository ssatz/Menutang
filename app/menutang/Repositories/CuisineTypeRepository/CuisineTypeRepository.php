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

class CuisineTypeRepository extends BaseRepository implements ICuisineTypeRepository {


    /**
     * @param CuisineType $cuisineType
     * @param ICacheService $cache
     */
    public function __construct(CuisineType $cuisineType, ICacheService $cache)
    {
        parent::__construct($cuisineType, $cache);

    }
}