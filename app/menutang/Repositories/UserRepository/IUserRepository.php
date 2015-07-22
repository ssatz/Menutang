<?php namespace Repositories\UserRepository;
/*
 * This file is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

interface IUserRepository
{

    public function create(array $data);

    public function findOrFail($id);

    public function updateDetails($id,array $data);
    public function updateLastLogin($id);
    public function getUserDetails($userId);
    public function getUserCount();
}