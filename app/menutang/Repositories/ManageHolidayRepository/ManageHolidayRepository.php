<?php
/*
 * This file(ManageHolidayRepository.php) is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Repositories\ManageHolidayRepository;


use Repositories\BaseRepository;
use Services\Cache\ICacheService;
use BusinessHolidays;


class ManageHolidayRepository extends BaseRepository implements IManageHolidayRepository {
    public function __construct(BusinessHolidays $holidays, ICacheService $cache)
    {
        $cache->tag(get_class($holidays));
        parent::__construct($holidays, $cache);
    }

    public function findHolidayByBUID($businessId)
    {
        return $this->model->where('business_info_id','=',$businessId)
                    ->select('id','business_info_id','title','holiday_date','start_time','end_time','holiday_reason')
                    ->get();
    }


}