<?php
/*
 * This file is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Repositories\BusinessUserRepository;


use BusinessUser;
use Repositories\BaseRepository;
use Services\Cache\ICacheService;

class  BusinessUserRepository extends BaseRepository implements IBusinessUserRepository
{

    /**
     * @param BusinessUser $businessUser
     */
    public function __construct(BusinessUser $businessUser, ICacheService $cache)
    {
        parent::__construct($businessUser, $cache);

    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findOrFail($id)
    {
        return $this->model->findOrFail($id);
    }
}