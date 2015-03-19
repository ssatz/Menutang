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
    protected $dateTime;
    /**
     * @param User $user
     * @param ICacheService $cache
     */
    public function __construct(User $user, ICacheService $cache,Carbon $carbon)
    {
        $this->dateTime =$carbon;
        parent::__construct($user, $cache);

    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        $user = $this->model;
        $user->email =trim($data['email']);
        $user->mobile =trim($data['mobile']);
        $user->first_name =trim($data['first_name']);
        $user->last_name=trim($data['last_name']);
        $user->password = Hash::make(trim($data['password']));
        $user->last_login = $this->dateTime->now();
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

    public function updateDetails($id, array $data)
    {
        $this->model->where('id','=',$id)->update($data);
    }

    public function updateLastLogin($id)
    {
        $data =[
        'last_login'=>$this->dateTime->now()
        ];
        $this->model->where('id','=',$id)->update($data);
    }

    /**
     * @param $email
     * @return string
     */
    private function createActivationCode($email)
    {
        $value = str_shuffle(sha1($email.spl_object_hash($this).microtime(true)));

        return hash_hmac('sha1', $value, Config::get('app.key'));
    }
}