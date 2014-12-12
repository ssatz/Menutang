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


interface IBusinessUserRepository
{
    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * @param $id
     * @return mixed
     */
    public function findOrFail($id);
}