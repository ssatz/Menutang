<?php
/*
 * This file is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Repositories\UserRepository;

use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Bind the user repository interface to our Eloquent-specific implementation
        // This service provider is called every time the application starts
        $this->app->bind(
            'Repositories\UserRepository\IUserRepository',
            'Repositories\UserRepository\UserRepository'
        );
    }
}