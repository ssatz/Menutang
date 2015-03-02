<?php
/*
 * This file(WeekdaysRepository.php) is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Repositories\WeekdaysRepository;


use Repositories\BaseRepository;
use Services\Cache\ICacheService;

class WeekdaysRepository extends BaseRepository implements IWeekdaysRepository {
    /**
     * @param City $manageCity
     */
    public function __construct(City $manageCity, ICacheService $cache)
    {
        parent::__construct($manageCity, $cache);
    }
}