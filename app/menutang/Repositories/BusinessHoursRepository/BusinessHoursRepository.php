<?php
/*
 * This file(BusinessHoursRepository.php) is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Repositories\BusinessHoursRepository;


use Repositories\BaseRepository;
use Services\Cache\ICacheService;
use BusinessHours;


class BusinessHoursRepository extends BaseRepository implements IBusinessHoursRepository {
    /**
     * @param BusinessHours $hours
     * @param ICacheService $cache
     */
    public function __construct(BusinessHours $hours, ICacheService $cache)
    {
        parent::__construct($hours, $cache);

    }


}