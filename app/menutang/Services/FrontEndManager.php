<?php
/*
 * This file(FrontEndManager.php) is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Services;

use Repositories\ManageBusinessRepository\IManageBusinessRepository;


class FrontEndManager {

    protected  $buManager;

    function __construct(IManageBusinessRepository $buManager)
    {
        $this->buManager = $buManager;
    }

    public function searchQuery($query)
    {
       return $this->buManager->findBySearch($query);
    }
}