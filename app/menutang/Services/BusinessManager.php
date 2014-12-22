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

use Exception;
use Illuminate\Database\DatabaseManager;
use Repositories\ManageBusinessRepository\IManageBusinessRepository;
use Repositories\ManageCityRepository\IManageCityRepository;
use Repositories\MenuCategoryRepository\IMenuCategoryRepository;
use Repositories\PaymentTypeRepository\IPaymentTypeRepository;
use Services\Cache\ICacheService;
use Services\Validations\BusinessValidator;
use Services\Validations\MenuItemValidator;


class BusinessManager
{

    /**
     * @var
     */
    public $errors;
    /**
     * @var IManageRestaurantRepository
     */
    protected $manageBusiness;
    /**
     * @var ICacheService
     */
    protected $cacheService;
    /**
     * @var DatabaseManager
     */
    protected $db;
    /**
     * @var BusinessValidator
     */
    protected $validations;
    /**
     * @var ManageCityRepository
     */
    protected $manageCity;

    /**
     * @var IPaymentTypeRepository
     */
    protected $managePayments;

    /**
     * @var IMenuCategoryRepository
     */
    protected $manageCategory;

    /**
     * @var MenuItemValidator
     */
    protected $menuItemValidator;

    /**
     * @param IManageBusinessRepository $manageRestaurant
     * @param ICacheService $cacheService
     */
    public function __construct(IManageBusinessRepository $manageBusiness,
                                ICacheService $cacheService,
                                BusinessValidator $businessValidator,
                                DatabaseManager $databaseManager,
                                IManageCityRepository $manageCityRepository,
                                IPaymentTypeRepository $paymentTypeRepository,
                                IMenuCategoryRepository $menuCategoryRepository,
                                MenuItemValidator $menuItemValidator)
    {
        $this->manageBusiness = $manageBusiness;
        $this->cacheService = $cacheService;
        $this->validations = $businessValidator;
        $this->db = $databaseManager;
        $this->manageCity = $manageCityRepository;
        $this->managePayments = $paymentTypeRepository;
        $this->manageCategory = $menuCategoryRepository;
        $this->menuItemValidator = $menuItemValidator;
    }

    /**
     * @return mixed
     */
    public function getAllBusiness()
    {
        $restaurants = [];
        $restaurants[0] = $this->manageBusiness->getAllBusiness();
        $restaurants[1] = $this->manageBusiness->totalBusinesscount();
        return $restaurants;
    }

    /**
     * @param $slug
     * @return mixed
     */
    public function editBusiness($slug)
    {
        return $this->manageBusiness->findBusinessBySlug($slug);
    }

    /**
     * @return mixed
     */
    public function getAllCity()
    {
        return $this->manageCity->getAll();
    }

    /**
     * @return mixed
     */
    public function getAllPayments()
    {
        return $this->managePayments->getAll();
    }

    /**
     * @param array $input
     * @param $slug
     */
    public function updateBusiness(array $input, $slug)
    {

        $this->validations->with($input);
        if ($this->validations->passes()) {
            $this->db->beginTransaction();
            try {
                $this->manageBusiness->update($input, $slug);
            } catch (Exception $e) {
                $this->db->rollback();
                throw new Exception($e->getMessage());
            }
            $this->db->commit();
            return true;
        }
        $this->errors = $this->validations->getErrors();
        return false;
    }

    /**
     * @return mixed
     */
    public function getAllMenuCategory()
    {
        return $this->manageCategory->getAll();
    }

    /**
     * @param array $input
     * @param $slug
     */
    public function insertMenuItem(array $input, $slug)
    {
        $this->menuItemValidator->with($input);
        $this->errors = $this->menuItemValidator->getErrors();
        return false;
    }
}