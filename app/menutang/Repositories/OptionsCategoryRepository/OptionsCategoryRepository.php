<?php
/*
 * This file(OptionsCategoryRepository.php) is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Repositories\OptionsCategoryRepository;


use Repositories\BaseRepository;
use OptionCategory;
use Services\Cache\ICacheService;

class OptionsCategoryRepository extends BaseRepository implements IOptionsCategoryRepository {
    public function __construct(OptionCategory $optionCategory,
                                ICacheService $cache)
    {
        $cache->tag(get_class($optionCategory));
        parent::__construct($optionCategory, $cache);
    }

    public function getOptions($menuId)
    {
       return $this->model->wherehas('optionItem',function($query) use($menuId) {
            $query->where('menu_item_id', '=', $menuId);
        })->with('optionItem')->with('attribute.attributeGroup')->get();
    }


}