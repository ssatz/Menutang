<?php
/*
 * This file(ICartItemRepository.php) is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Repositories\CartItemRepository;


interface ICartItemRepository {
    public function find($id);
    public function create(array $data);
    public function update(array $data, $id);
    public function delete($id);
    public function findMenuItemId($menuItemId,$cartId,$itemAddon=null);
    public function findByHash($hash);
    public function updateByHash(array $data,$hash);
    public function deleteByHash($hash);
}