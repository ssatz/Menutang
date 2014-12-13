<?php
/*
 * This file is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Services;


use Illuminate\Support\ServiceProvider;


class MenutangServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $app = $this->app;
        $app->bind(
            'Repositories\AdminRepository\IAdminRepository',
            'Repositories\AdminRepository\AdminRepository'
        );
        $app->bind(
            'Repositories\BusinessUserRepository\IBusinessUserRepository',
            'Repositories\BusinessUserRepository\BusinessUserRepository'
        );
        $app->bind(
            'Repositories\UserRepository\IUserRepository',
            'Repositories\UserRepository\UserRepository'
        );
        $app->bind(
            'Repositories\ManageBusinessRepository\IManageBusinessRepository',
            'Repositories\ManageBusinessRepository\ManageBusinessRepository'
        );
        $app->bind(
            'Services\Cache\ICacheService',
            'Services\Cache\CacheService'
        );
    }
}