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
use DatabaseCommand;
use AdminDBSeedCommand;
use ViewsCommand;


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
            'Repositories\MenuAddonRepository\IMenuAddonRepository',
            'Repositories\MenuAddonRepository\MenuAddonRepository'
        );
        $app->bind(
            'Repositories\ManageStateRepository\IManageStateRepository',
            'Repositories\ManageStateRepository\ManageStateRepository'
        );
        $app->bind(
            'Repositories\BusinessHoursRepository\IBusinessHoursRepository',
            'Repositories\BusinessHoursRepository\BusinessHoursRepository'
        );
        $app->bind(
            'Repositories\OptionsCategoryRepository\IOptionsCategoryRepository',
            'Repositories\OptionsCategoryRepository\OptionsCategoryRepository'
        );
        $app->bind(
            'Repositories\CartOptionRepository\ICartOptionRepository',
            'Repositories\CartOptionRepository\CartOptionRepository'
        );
        $app->bind(
            'Repositories\OptionItemRepository\IOptionItemRepository',
            'Repositories\OptionItemRepository\OptionItemRepository'
        );
        $app->bind(
            'Repositories\WeekdaysRepository\IWeekdaysRepository',
            'Repositories\WeekdaysRepository\WeekdaysRepository'
        );
        $app->bind(
            'Repositories\ManageHolidayRepository\IManageHolidayRepository',
            'Repositories\ManageHolidayRepository\ManageHolidayRepository'
        );
        $app->bind(
            'Repositories\UserDeliveryAddress\IUserDeliveryAddress',
            'Repositories\UserDeliveryAddress\UserDeliveryAddress'
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
        $this->app->bindShared('command.db', function($app)
        {
            return new DatabaseCommand();
        });
        $this->commands(
            'command.db'
        );
        $this->app->bindShared('command.views', function($app)
        {
            return new ViewsCommand();
        });
        $this->commands(
            'command.views'
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