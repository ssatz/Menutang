<?php
/*
 * This file is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Repositories\UserRepository;


use Repositories\BaseRepository;
use Services\Cache\ICacheService;
use User;

class UserRepository extends BaseRepository implements IuserRepository
{

    public function __construct(User $user, ICacheService $cache)
    {
        parent::__construct($user, $cache);

    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function findOrFail($id)
    {
        return $this->model->findOrFail($id);
    }
}