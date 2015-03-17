<?php
/*
 * This file(MenuAddonRepository.php) is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Repositories\MenuAddonRepository;


use Repositories\BaseRepository;
use ItemAddon;

class MenuAddonRepository extends  BaseRepository implements IMenuAddonRepository{
    /**
     * @param ItemAddon $menuItem
     */
    public function __construct(ItemAddon $menuItem)
    {
        parent::__construct($menuItem);

    }

    public function findByMenuId($menuId,$addonId)
    {
       return $this->model->where('menu_item_id','=',$menuId)->where('id','=',$addonId)->first();
    }

    /**
     * @param $id
     */
    public function find($id)
    {
       return $this->model->find($id);
    }

}