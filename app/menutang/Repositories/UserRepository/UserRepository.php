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


use Carbon\Carbon;
use Illuminate\Support\Facades\Config;
use Repositories\BaseRepository;
use Services\Cache\ICacheService;
use User;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository implements IUserRepository
{

    /**
     * @param User $user
     * @param ICacheService $cache
     */
    public function __construct(User $user, ICacheService $cache)
    {
        parent::__construct($user, $cache);

    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        $user = $this->model;
        $user->email = $data['email'];
        $user->mobile = $data['mobile'];
        $user->password = Hash::make($data['password']);
        $user->last_login = Carbon::now();
        $user->activation_code = $this->createActivationCode($data['email']);
        $user->save();
        return $user;
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