<?php
/*
 * This file(TimeCategoryRepository.php) is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Repositories\TimeCategoryRepository;


use Repositories\BaseRepository;
use TimeCategory;
use Services\Cache\ICacheService;

class TimeCategoryRepository extends BaseRepository implements ITimeCategoryRepository {

    public function __construct(TimeCategory $timeCategory, ICacheService $cache)
    {
        $cache->tag(get_class($timeCategory));
        parent::__construct($timeCategory, $cache);

    }

}