<?php
/*
 * This file(CartOptionRepository.php) is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Repositories\CartOptionRepository;


use Repositories\BaseRepository;
use Services\Cache\ICacheService;
use OptionCart;
class CartOptionRepository extends BaseRepository implements ICartOptionRepository {

    /**
     * @param OptionCart $optionCart
     * @param ICacheService $cache
     */
    public function __construct(OptionCart $optionCart, ICacheService $cache)
    {
        $cache->tag(get_class($optionCart));
        parent::__construct($optionCart, $cache);

    }

    /**
     * @param $cartId
     * @return mixed
     */
    public function findOptionCartByCart($cartId)
    {
       return $this->model->where('cart_items_id','=',$cartId)->get();
    }

    /**
     * @param $id
     * @param array $data
     * @return mixed
     */
    public function updateByHash($optionItemId,$hash,array $data)
    {
       return $this->model->where('cart_item_hash','=',$hash)->where('options_items_id','=',$optionItemId)->update($data);
    }

    /**
     * @param array $options
     * @param $cartItemId
     * @return mixed
     */
    public function findCartOptions(array $options,$cartHash)
    {
      return $this->model->whereIn('options_items_id',$options)
                         ->where('cart_item_hash','=',$cartHash)
                        ->get();
    }

    /**
     * @param array $options
     * @return mixed
     */
    public function findCartItemIdByOptions(array $options)
    {
        return $this->model->whereIn('options_items_id',$options)
            ->get();
    }

}