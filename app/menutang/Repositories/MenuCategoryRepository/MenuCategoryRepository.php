<?php
/*
 * This file is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Repositories\MenuCategoryRepository;


use Repositories\BaseRepository;
use Services\Cache\ICacheService;
use MenuCategory;

class MenuCategoryRepository extends BaseRepository implements IMenuCategoryRepository
{
    /**
     * @param City $manageCity
     */
    public function __construct(MenuCategory $menuCategory, ICacheService $cache)
    {
        parent::__construct($menuCategory, $cache);
    }

    /**
     * Return all last item
     * @return json
     */
    public function getLastInsertedItem()
    {
        return $this->model->orderBy('created_at', 'DESC')->first();
    }


}