<?php
/*
 * This file(BusinessTypeRepository.php) is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Repositories\BusinessTypeRepository;


use Repositories\BaseRepository;
use BusinessType;

class BusinessTypeRepository extends BaseRepository implements IBusinessTypeRepository
{
    /**
     * @param BusinessUser $businessUser
     */
    public function __construct(BusinessType $buType, ICacheService $cache)
    {
        parent::__construct($buType, $cache);

    }
}