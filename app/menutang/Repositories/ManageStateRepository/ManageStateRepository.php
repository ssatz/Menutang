<?php
/*
 * This file(ManageStateRepository.php) is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Repositories\ManageStateRepository;


use Repositories\BaseRepository;
use State;
use Services\Cache\ICacheService;


class ManageStateRepository extends BaseRepository implements IManageStateRepository{
    public function __construct(State $state, ICacheService $cache)
    {
        $cache->tag(get_class($state));
        parent::__construct($state, $cache);
    }
    public function getAllState()
    {
       return $this->model->all();
    }

}