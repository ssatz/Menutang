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
use Illuminate\Support\Collection;
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
use Maatwebsite\Excel\Excel;
use Services\Validations\MenuUploadValidator;
use Repositories\BusinessHoursRepository\IBusinessHoursRepository;
use Repositories\TimeCategoryRepository\ITimeCategoryRepository;


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


    /**
     * @var IManageDeliveryAreaRepository
     */
    protected  $deliveryArea;

    /**
     * @var Excel
     */
    protected $excel;

    /**
     * @var MenuUploadValidator
     */
    protected $menuUploadValidator;
    /**
     * @var IBusinessHoursRepository
     */
    protected $businessHours;

    protected $businessTimes;
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
                                IBusinessHoursRepository $businessHoursRepository,
                                CategoryValidator $categoryValidator,
                                ICuisineTypeRepository $cuisineTypeRepository,
                                IManageDeliveryAreaRepository $deliveryAreaRepository,
                                IStatusRepository $statusRepository,
                                MenuUploadValidator $menuUploadValidator,
                                ITimeCategoryRepository $timeCategoryRepository,
                                Excel $excel)
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
        $this->excel =$excel;
        $this->menuUploadValidator = $menuUploadValidator;
        $this->businessHours = $businessHoursRepository;
        $this->businessTimes = $timeCategoryRepository;
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
    public function getAllBusinessHours()
    {
        return $this->businessHours->getAll();
    }

    public function getAllBusinessTimes()
    {
        return $this->businessTimes->getAll();
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

    /**
     * @return mixed
     */
    public function getAllDeliveryArea()
    {
        return $this->deliveryArea->getAll();
    }

    /**
     * @return mixed
     */
    public function deliverySearch()
    {
       return $this->deliveryArea->searchDeliveryArea();
    }
    public function getTimeBuHr($slug)
    {
     $business= $this->manageBusiness->findBusinessBySlug($slug) ;
      return $this->businessHours->findTimeByBU($business->id);
    }
    /**
     * @param array $data
     * @param $slug
     * @return bool
     * @throws Exception
     */
    public function uploadMenu(array $data,$slug)
    {
        $this->menuUploadValidator->with($data);
        if ($this->menuUploadValidator->passes()) {
            $collection = new Collection();
            $file = $data['menu_upload']->getRealPath();
            $budID =$this->manageBusiness->findBusinessBySlug($slug)->id;
            $this->excel->load($file, function ($reader) use ($collection, $budID) {
                $reader->each(function ($sheet) use ($collection, $budID) {
                    (int)$count = -1;
                    $title = str_replace('_',' ', $sheet->getTitle());
                    $category_id = $this->manageCategory->findOrCreate($title);
                    foreach ($sheet as $row) {
                        if (!is_null($row['item_name'])) {
                            $cell = [];
                            $count++;
                            $cell[$count]['item_name'] = $row['item_name'];
                            $cell[$count]['menu_category_id'] = $category_id;
                            $cell[$count]['business_info_id'] = $budID;
                            $cell[$count]['item_description'] = $row['item_description'];
                            $cell[$count]['item_price'] = $row['cost'];
                            $cell[$count]['is_veg'] = $row['veg'];
                            $cell[$count]['is_non_veg'] = $row['non_veg'];
                            $cell[$count]['is_egg'] = $row['egg'];
                            $cell[$count]['is_spicy'] = $row['spicy'];
                            $cell[$count]['is_popular'] = $row['popular_food'];
                            $cell[$count]['item_status'] = $row['menu_status'];
                            $cell[$count]['available_breakfast'] = boolval($row['available_at_breakfast']);
                            $cell[$count]['available_lunch'] = boolval($row['available_at_lunch']);
                            $cell[$count]['available_dinner'] = boolval($row['available_at_dinner']);
                            $cell[$count]['itemAddon'] = new Collection();
                        }
                        if (!is_null($row['item_addon_name'])) {
                            $addonItem = [];
                            $addonItem['addon_description'] = $row['item_addon_name'];
                            $addonItem['addon_price'] = $row['addon_price'];
                            $addonItem['addon_status'] = $row['addon_status'];
                            $cell[$count]['itemAddon']->push($addonItem);
                        }
                        if (!is_null($row['item_name'])) {
                            $collection->push($cell);
                        }
                    }
                });
            });
            $this->db->beginTransaction();
            try {
                $this->menuItemrepo->bulkInsert($collection,$budID);
            } catch (Exception $e) {
                $this->db->rollback();
                throw new Exception($e->getMessage());
            }
            $this->db->commit();
            return true;
        }
        $this->errors = $this->menuUploadValidator->getErrors();
        return false;
    }



}