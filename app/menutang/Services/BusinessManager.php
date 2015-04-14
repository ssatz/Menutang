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

use stdClass;
use Exception;
use DateTime;
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
use Repositories\WeekdaysRepository\IWeekdaysRepository;


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
    protected $weekdays;
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
                                IWeekdaysRepository $weekdaysRepository,
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
        $this->weekdays = $weekdaysRepository;
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
    public function getAllWeekDays()
    {
        return $this->weekdays->getAll();
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
    public function insertBusinessInfo(stdClass $input)
    {
        $this->validations->with($this->objectArray($input));
        if ($this->validations->passes()) {
            $this->db->beginTransaction();
            try {
                $this->manageBusiness->insert($this->objectArray($input));
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

   private function objectArray(stdClass $object)
   {
       $time=[];
       foreach ($object->timeDay as $key=>$hr ) {
           $openTime = new DateTime($hr->openTime);
           $closeTime= new DateTime($hr->closeTime);
           $time[$key] =[
               'time_category_id'=>(int)$hr->timeCategory,
               'open_time'=>$openTime->format('H:i:s'),
               'close_time'=>$closeTime->format('H:i:s'),
               'day'=>(array)$hr->day
           ];
       }
       $deliveryArea=[];
       foreach ($object->deliveryArea as $key=>$area) {
           if(!empty($area->area) && !empty($area->pincode) && $area->area!='' && $area->pincode!='')
           $deliveryArea[$key]=[
               'area'=>$area->area,
               'pincode'=>(int)$area->pincode
           ];
       }


       $data =[
         'businessInfo'=>[
             'business_name'=>$object->businessName,
            'business_type_id'=> (int)$object->businessType,
            'status_id'=>(int) $object->status,
            'budget'=>(float)$object->budget,
            'parcel_charges'=>(float)$object->parcelCharges,
            'is_door_delivery'=>(bool) $object->doorDelivery,
            'minimum_delivery_amt'=>(float)$object->minimumDeliveryAmount,
            'delivery_fee'=> (float)$object->deliveryFee,
            'is_rail_delivery'=> (bool)$object->railDelivery,
            'minimum_rail_deli_amt'=>isset($object->minimumRailDeliveryAmount)?(float)$object->minimumRailDeliveryAmount:0,
            'is_pickup_available'=>  (bool)$object->pickupAvailable,
            'minimum_pickup_amt'=>isset($object->minimumPickupAmount)?(float)$object->minimumPickupAmount:0,
            'is_outdoor_catering'=>(bool)$object->outdoorCatering,
            'outdoor_catering_comments'=>isset($object->outdoorCateringComments)?(string)$object->outdoorCateringComments:'',
            'is_party_hall'=> (bool)$object->partyHall,
            'party_hall_comments'=>isset($object->partyHallComments)?(string)$object->partyHallComments:'',
            'is_buffet'=> (bool)$object->buffet,
            'is_midnight_buffet'=>(bool)$object->midnightBuffet,
            'is_wifi_available'=>(bool)$object->wifi,
            'is_children_play_area'=>(bool)$object->childrenPlayArea,
            'is_garden_restaurant'=>(bool)$object->gardenRestaurant,
            'is_roof_top'=> (bool)$object->roofTop,
            'is_valet_parking'=> (bool)$object->valetParking,
            'is_boarding'=> (bool)$object->boarding,
            'boarding_comments'=>isset($object->boardingComments)?(string)$object->boardingComments:'',
            'is_bar_attached'=> (bool)$object->barAttached,
            'is_highway_res'=> (bool)$object->highwayRestaurant,
            'highway_details'=> isset($object->highwayRestaurantDetails)?(string)$object->highwayRestaurantDetails:'',
            'website'=>isset($object->website)?$object->website:'',
            'business_about'=>isset($object->aboutBusiness)?$object->aboutBusiness:'',
            'ischeckout_enable'=> $object->checkOutEnable,
            'avg_delivery_time'=> isset($object->avgDeliveryTime)?$object->avgDeliveryTime:'',
             ],
          'address'=>[
              'city_id'=>(int)$object->city,
              'address_line_1'=>(string)$object->businessAddress1,
              'address_line_2'=>(string)$object->businessAddress2,
              'address_gps_location'=>$object->gpsLocation,
              'address_landmark'=>(string)$object->businessLandmark,
              'postal_code'=>(int)$object->postalCode,
              'mobile'=>(float)$object->businessMobile,
          ],
          'payments'=>array_map(
              create_function('$value', 'return (int)$value;'),
              $object->payments
          ),
           'cuisineType'=>array_map(
               create_function('$value', 'return (int)$value;'),
               $object->cuisineType
           ),
          'time' => $time,
           'delivery'=>$deliveryArea,
           'fileData'=>$object->fileData
        ];

       return $data;
   }

}