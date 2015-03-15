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
use Services\Events\UserEventSubscriber;
use DBSettingsCommand;
use Services\Validations\CustomValidator;


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
            'Repositories\ManageCityRepository\IManageCityRepository',
            'Repositories\ManageCityRepository\ManageCityRepository'
        );
        $app->bind(
            'Repositories\PaymentTypeRepository\IPaymentTypeRepository',
            'Repositories\PaymentTypeRepository\PaymentTypeRepository'
        );
        $app->bind(
            'Repositories\MenuCategoryRepository\IMenuCategoryRepository',
            'Repositories\MenuCategoryRepository\MenuCategoryRepository'
        );
        $app->bind(
            'Repositories\ManageCountryRepository\IManageCountryRepository',
            'Repositories\ManageCountryRepository\ManageCountryRepository'
        );
        $app->bind(
            'Repositories\MenuItemRepository\IMenuItemRepository',
            'Repositories\MenuItemRepository\MenuItemRepository'
        );
        $app->bind(
            'Repositories\BusinessTypeRepository\IBusinessTypeRepository',
            'Repositories\BusinessTypeRepository\BusinessTypeRepository'
        );
        $app->bind(
            'Repositories\StatusRepository\IStatusRepository',
            'Repositories\StatusRepository\StatusRepository'
        );
        $app->bind(
            'Repositories\ManageDeliveryAreaRepository\IManageDeliveryAreaRepository',
            'Repositories\ManageDeliveryAreaRepository\ManageDeliveryAreaRepository'
        );
        $app->bind(
            'Repositories\CuisineTypeRepository\ICuisineTypeRepository',
            'Repositories\CuisineTypeRepository\CuisineTypeRepository'
        );
        $app->bind(
            'Repositories\TimeCategoryRepository\ITimeCategoryRepository',
            'Repositories\TimeCategoryRepository\TimeCategoryRepository'
        );
        $app->bind(
            'Repositories\CartRepository\ICartRepository',
            'Repositories\CartRepository\CartRepository'
        );
        $app->bind(
            'Repositories\CartItemRepository\ICartItemRepository',
            'Repositories\CartItemRepository\CartItemRepository'
        );
        $app->bind(
            'Services\Cache\ICacheService',
            'Services\Cache\CacheService'
        );
        $this->app->bindShared('command.settings', function($app)
        {
            return new DBSettingsCommand($app);
        });
        $this->commands(
            'command.settings'
        );
    }

    public function boot() {
        $this->app->validator->resolver( function( $translator, $data, $rules, $messages = array(), $customAttributes = array() ) {
            return new CustomValidator( $translator, $data, $rules, $messages, $customAttributes );
        } );

        $this->app->events->subscribe(new UserEventSubscriber(
                $this->app['mailer'])
        );
    }
    public function provides()
    {
        return array('auth.reminder');
    }
}