<?php
/*
 * This file(ICartOptionRepository.php) is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Repositories\CartOptionRepository;


interface ICartOptionRepository {
    public function findOptionCartByCart($cartId);
    public function updateByHash($optionItemId,$hash,array $data);
    public function findCartOptions(array $options,$cartHash);
    public function  findCartItemIdByOptions(array $options);
}