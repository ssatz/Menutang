<?php
/*
 * This file(StatusRepository.php) is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Repositories\StatusRepository;


use Repositories\BaseRepository;
use Status;
use Services\Cache\ICacheService;

class StatusRepository extends BaseRepository implements IStatusRepository
{
    public function __construct(Status $status, ICacheService $cache)
    {
        $cache->tag(get_class($status));
        parent::__construct($status, $cache);
    }
}