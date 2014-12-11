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


use Repositories\BaseRepository;
use BusinessUser;

class  BusinessUserRepository extends BaseRepository implements IBusinessUserRepository
{
    protected $businessUser;

    public function __construct(BusinessUser $businessUser)
    {
        parent::__construct($businessUser);
        $this->$businessUser = $businessUser;
    }

    public function create(array $data)
    {
        return $this->$businessUser->create($data);
    }

    public function findOrFail($id)
    {
        return $this->$businessUser->findOrFail($id);
    }
}