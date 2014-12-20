<?php
/*
 * This file is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Repositories\AdminRepository;


use Admin;
use Repositories\BaseRepository;
use Services\Cache\ICacheService;

class AdminRepository extends BaseRepository implements IAdminRepository
{
    /**
     * @var Admin
     */
    protected $admin;

    /**
     * @param Admin $admin
     */
    public function __construct(Admin $admin, ICacheService $cache)
    {
        parent::__construct($admin, $cache);

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