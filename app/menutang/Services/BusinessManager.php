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
use Repositories\CuisineTypeRepository\ICuisineTypeRepository;
use Repositories\ManageBusinessRepository\IManageBusinessRepository;
use Repositories\ManageCityRepository\IManageCityRepository;
use Repositories\MenuCategoryRepository\IMenuCategoryRepository;
use Repositories\MenuItemRepository\IMenuItemRepository;
use Repositories\PaymentTypeRepository\IPaymentTypeRepository;
use Repositories\StatusRepository\IStatusRepository;
use Services\Cache\ICacheService;
use Services\Validations\BusinessValidator;
use Services\Validations\CategoryValidator;
use Services\Validations\MenuItemValidator;
use Repositories\BusinessTypeRepository\IBusinessTypeRepository;
use Repositories\ManageDeliveryAreaRepository\IManageDeliveryAreaRepository;
use ArrayObject;



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
     * @var IMenuItemRepository
     */
    protected $menuItemrepo;

    /**
     * @var IBusinessTypeRepository
     */
    protected $buTyperepo;

    /**
     * @var CategoryValidator
     */
    protected $categoryValidator;

    /**
     * @var IStatusRepository
     */
    protected $statusRepo;

    /**
     * @var ICuisineTypeRepository
     *
     *
     */
    protected  $cuisineType;


    protected  $deliveryArea;
    /**
     * @param IManageBusinessRepository $manageBusiness
     * @param ICacheService $cacheService
     * @param BusinessValidator $businessValidator
     * @param DatabaseManager $databaseManager
     * @param IManageCityRepository $manageCityRepository
     * @param IPaymentTypeRepository $paymentTypeRepository
     * @param IMenuCategoryRepository $menuCategoryRepository
     * @param MenuItemValidator $menuItemValidator
     * @param IMenuItemRepository $menuItem
     * @param IBusinessTypeRepository $buType
     * @param CategoryValidator $categoryValidator
     * @param IStatusRepository $statusRepository
     */
    public function __construct(IManageBusinessRepository $manageBusiness,
                                ICacheService $cacheService,
                                BusinessValidator $businessValidator,
                                DatabaseManager $databaseManager,
                                IManageCityRepository $manageCityRepository,
                                IPaymentTypeRepository $paymentTypeRepository,
                                IMenuCategoryRepository $menuCategoryRepository,
                                MenuItemValidator $menuItemValidator,
                                IMenuItemRepository $menuItem,
                                IBusinessTypeRepository $buType,
                                CategoryValidator $categoryValidator,
                                ICuisineTypeRepository $cuisineTypeRepository,
                                IManageDeliveryAreaRepository $deliveryAreaRepository,
                                IStatusRepository $statusRepository)
    {
        $this->manageBusiness = $manageBusiness;
        $this->cacheService = $cacheService;
        $this->validations = $businessValidator;
        $this->db = $databaseManager;
        $this->manageCity = $manageCityRepository;
        $this->managePayments = $paymentTypeRepository;
        $this->manageCategory = $menuCategoryRepository;
        $this->menuItemValidator = $menuItemValidator;
        $this->menuItemrepo = $menuItem;
        $this->categoryValidator = $categoryValidator;
        $this->buTyperepo = $buType;
        $this->statusRepo = $statusRepository;
        $this->cuisineType =$cuisineTypeRepository;
        $this->deliveryArea=$deliveryAreaRepository;
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
     * @return mixed
     */
    public function getAllCuisineType()
    {
        return $this->cuisineType->getAll();
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
     * @return mixed
     */
    public function getAllMenuItem()
    {
        return $this->menuItemrepo->getAll();
    }

    /**
     * @param $slug
     * @return mixed
     */
    public function getMenuItemAddon($slug,$categoryId)
    {
        return $this->menuItemrepo->getMenuItemAddon($slug,$categoryId);
    }
    /**
     * @param array $input
     * @param $slug
     */
    public function insertOrUpdateMenuItem(array $input, $slug)
    {
        $this->db->beginTransaction();
        try {
            $this->menuItemrepo->insertOrUpdate($input, $slug);
        } catch (Exception $e) {
            $this->db->rollback();
            throw new Exception($e->getMessage());
        }
        $this->db->commit();
        return true;

    }

    /**
     * @param array $input
     * @return mixed
     * @throws Exception
     */
    public function addCategory(array $input)
    {
        $this->categoryValidator->with($input);
        if ($this->categoryValidator->passes()) {
            $this->db->beginTransaction();
            try {
                $this->manageCategory->create($input);
            } catch (Exception $e) {
                $this->db->rollback();
                throw new Exception($e->getMessage());
            }
            $this->db->commit();
            return $this->manageCategory->getLastInsertedItem()->toJson();
        }
        $arrayObject = new ArrayObject();
        $arrayObject->offsetSet(1, 'Error');
        $arrayObject->offsetSet(0, $this->categoryValidator->getErrors());
        return $arrayObject;
    }

    /**
     * @param array $input
     * @throws Exception
     */
    public function insertBusinessInfo(array $input)
    {
        $this->validations->with($input);
        if ($this->validations->passes()) {
            $this->db->beginTransaction();
            try {
                $this->manageBusiness->insert($input);
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
    public function getAllBusinessType()
    {
        return $this->buTyperepo->getAll();
    }

    /**
     * @return mixed
     */
    public function getAllStatusType()
    {
        return $this->statusRepo->getAll();
    }
    public function getAllDeliveryArea()
    {
        return $this->deliveryArea->getAll();
    }
    public function deliverySearch()
    {
       return $this->deliveryArea->searchDeliveryArea();
    }

}