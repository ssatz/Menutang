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


use Illuminate\Support\Facades\Cache;
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
        $cache->tag(get_class($hours));
        parent::__construct($hours, $cache);

    }

    public function findTimeByBU($buId)
    {
        $key = md5(__METHOD__.$buId);
        if ($this->cache->has($key)) {
            return $this->cache->get($key);
        }
        $buhr= $this->model->with('timeCategory')->where('business_info_id','=',$buId)
            ->select('id','time_category_id')->orderBy('id')
            ->get();
        $this->cache->put($key, $buhr);
        return $buhr;

    }


}