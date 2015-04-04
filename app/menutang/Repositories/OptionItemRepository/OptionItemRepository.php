<?php
/*
 * This file(OptionItemRepository.php) is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Repositories\OptionItemRepository;


use Repositories\BaseRepository;
use OptionItem;
use Services\Cache\ICacheService;

class OptionItemRepository extends BaseRepository implements  IOptionItemRepository {

    /**
     * @param OptionCart $optionCart
     * @param ICacheService $cache
     */
    public function __construct(OptionItem $optionItem, ICacheService $cache)
    {
        $cache->tag(get_class($optionItem));
        parent::__construct($optionItem, $cache);

    }

    public function findPriceById($id)
    {
        return $this->model->where('id','=',$id)->first()->price;
    }


}