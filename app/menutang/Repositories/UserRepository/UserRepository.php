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
use User;

class UserRepository extends BaseRepository implements IuserRepository
{

    protected $user;

    public function __construct(User $user)
    {
        parent::__construct($user);
        $this->user = $user;
    }

    public function create(array $data)
    {
        return $this->user->create($data);
    }

    public function findOrFail($id)
    {
        return $this->user->findOrFail($id);
    }
}