<?php
/*
 * This file(IMenuItemRepository.php) is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Repositories\MenuItemRepository;


interface IMenuItemRepository
{

    public function insertOrUpdate(array $data, $slug);
    public function getMenuItemAddon($slug,$categoryId);
}