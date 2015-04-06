<?php
/*
 * This file(ICartRepository.php) is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Repositories\CartRepository;


interface ICartRepository {
    public function create(Array $data);
    public function findByUid($uid);
    public function findByUserId($userId);
    public function delete($id);
}