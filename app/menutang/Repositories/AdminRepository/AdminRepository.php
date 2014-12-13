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


use Repositories\BaseRepository;
use Admin;

class AdminRepository extends BaseRepository implements IAdminRepository
{
    /**
     * @var Admin
     */
    protected $admin;

    /**
     * @param Admin $admin
     */
    public function __construct(Admin $admin)
    {
        parent::__construct($admin);
        $this->admin = $admin;
    }
    /**
     * @param $id
     * @return mixed
     */
    public function findOrFail($id)
    {
        return $this->admin->findOrFail($id);
    }
}