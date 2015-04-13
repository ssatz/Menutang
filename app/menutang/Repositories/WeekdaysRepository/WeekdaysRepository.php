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
use WeekDays;

class WeekdaysRepository extends BaseRepository implements IWeekdaysRepository {
    /**
     * @param City $manageCity
     */
    public function __construct(WeekDays $weekDays, ICacheService $cache)
    {
        $cache->tag(get_class($weekDays));
        parent::__construct($weekDays, $cache);
    }
}