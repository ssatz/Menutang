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

use League\Flysystem\File;
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
use Services\Validations\BusinessTypeValidator;
use Services\Validations\CuisineTypeValidator;
use Services\Validations\BusinessEditValidator;
use Repositories\ManageHolidayRepository\IManageHolidayRepository;
use Services\Helper;
use Illuminate\Filesystem\Filesystem;
use Intervention\Image\ImageManager;
use Services\Validations\PaymentTypeValidator;


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
     * @var BusinessEditValidator
     */
    protected $businessEditValidator;

    /**
     * @var MenuUploadValidator
     */
    protected $menuUploadValidator;
    /**
     * @var IBusinessHoursRepository
     */
    protected $businessHours;

    /**
     * @var ITimeCategoryRepository
     */
    protected $businessTimes;
    /**
     * @var IWeekdaysRepository
     */
    protected $weekdays;
    /**
     * @var BusinessTypeValidator
     */
    protected $businessTypeValidator;
    /**
     * @var CuisineTypeValidator
     */
    protected $cuisineTypeValidator;
    /**
     * @var IManageHolidayRepository
     */
    protected $holiday;
    /**
     * @var ImageManager
     */
    protected $imageHelper;

    /**
     * @var Filesystem
     */
    protected $file;

    /**
     * @var Helper
     */
    protected $helper;
    protected $paymentTypeValidator;
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
                                BusinessTypeValidator $businessTypeValidator,
                                CuisineTypeValidator $cuisineTypeValidator,
                                BusinessEditValidator $businessEditValidator,
                                IManageHolidayRepository $businessHoliday,
                                Filesystem $filesystem,
                                ImageManager $imageManager,
                                Helper $helper,
                                PaymentTypeValidator $paymentTypeValidator,
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
        $this->businessTypeValidator = $businessTypeValidator;
        $this->cuisineTypeValidator = $cuisineTypeValidator;
        $this->businessEditValidator=$businessEditValidator;
        $this->holiday = $businessHoliday;
        $this->helper=$helper;
        $this->file= $filesystem;
        $this->imageHelper = $imageManager;
        $this->paymentTypeValidator = $paymentTypeValidator;
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
     * @param $slug
     * @return mixed
     */
    public function findByHoliday($slug){

       $buId= $this->manageBusiness->findBusinessBySlug($slug);
        return $this->holiday->findHolidayByBUID($buId->id);
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

    /**
     * @return mixed
     */
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
        $address= $input['address']['id'];
        $this->businessEditValidator->excludeId=$address;
        $this->businessEditValidator->with($input);
        if ($this->businessEditValidator->passes()) {
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
        $this->errors = $this->businessEditValidator->getErrors();
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
     * @return mixed
     */
    public function getBUTypeWithCuisineType()
    {
        return $this->buTyperepo->getBUTypeWithCuisineType();
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
    public function deliverySearch($area)
    {
       return $this->deliveryArea->searchDeliveryArea($area);
    }

    /**
     * @param array $input
     * @return array
     */
    public function addBusinessType(array $input)
    {
        $this->businessTypeValidator->with($input);
        if($this->businessTypeValidator->passes()) {
            $this->db->beginTransaction();
            try {
               $buType= $this->buTyperepo->create($input);
            } catch (Exception $e) {
                $this->db->rollback();
                $error =[
                    'result'=>false
                    ];
                return $error;
            }
            $this->db->commit();
            $error =[
                'result'=>true,
                'buType'=>json_decode($buType,true)
            ];
            return $error;
        }
        $error =[
            'result'=>false,
            'error'=>json_decode($this->businessTypeValidator->getErrors(),true)
        ];
        return $error;
    }

    /**
     * @param $id
     * @param array $data
     * @return mixed
     */
    public function addOrUpdateBusinessType($id,array $data)
    {
        $this->businessTypeValidator->excludeId=$id;
        $this->businessTypeValidator->with($data);
        if($this->businessTypeValidator->passes()) {
            if ($id > 0) {
                $this->buTyperepo->update($data, $id);
                return true;
            }
             $this->buTyperepo->create($data);
             return true;
        }
        $this->errors= $this->businessTypeValidator->getErrors();
        return false;
    }

    public function addOrUpdateCuisineType(array $data){
        unset($data['fileData']);
        $this->cuisineTypeValidator->excludeId=$data['id'];
        $this->cuisineTypeValidator->with($data);
        if($this->cuisineTypeValidator->passes()) {
            if ($data['id'] > 0) {
                if($this->imageHelper->make($data['cuisine_image'])->width()==500 &&
                    $this->imageHelper->make($data['cuisine_image'])->height()==300) {
                    $data['cuisine_image'] = $this->imageHelper->make($data['cuisine_image'])

                        ->encode('data-url')->getEncoded();
                }
                else {
                    $data['cuisine_image'] = $this->imageHelper->make($data['cuisine_image'])
                        ->resize(500, 300)
                        ->encode('data-url')->getEncoded();
                }
                $this->cuisineType->update($data, $data['id']);
                return true;
            }
            unset($data['id']);
            $this->cuisineType->create($data);
            return true;
        }
        $this->errors= $this->cuisineTypeValidator->getErrors();
        return false;
    }

    public function addOrUpdatePaymentType(array $data){
        $this->paymentTypeValidator->excludeId=$data['id'];
        $this->paymentTypeValidator->with($data);
        if($this->paymentTypeValidator->passes()) {
            if ($data['id'] > 0) {
                $this->managePayments->update($data, $data['id']);
                return true;
            }
            unset($data['id']);
            $this->managePayments->create($data);
            return true;
        }
        $this->errors= $this->paymentTypeValidator->getErrors();
        return false;
    }

    /**
     * @param array $input
     * @return array
     */
    public function addCuisineType(array $input)
    {
        $this->cuisineTypeValidator->with($input);
        if($this->cuisineTypeValidator->passes()) {
            $this->db->beginTransaction();
            try {
                 $this->cuisineType->create($input);
            } catch (Exception $e) {
                $this->db->rollback();
                $error =[
                    'result'=>false
                ];
                return $error;
            }
            $this->db->commit();
            $error =[
                'result'=>true,
                'cuType'=>json_decode($this->getAllCuisineType(),true)
            ];
            return $error;
        }
        $error =[
            'result'=>false,
            'error'=>json_decode($this->cuisineTypeValidator->getErrors(),true)
        ];
        return $error;
    }

    /**
     * @param $slug
     * @return mixed
     */
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
                            $cell[$count]['is_veg'] = boolval($row['veg']);
                            $cell[$count]['is_non_veg'] =boolval($row['non_veg']);
                            $cell[$count]['is_egg'] = boolval($row['egg']);
                            $cell[$count]['is_spicy'] = boolval($row['spicy']);
                            $cell[$count]['is_popular'] = boolval($row['popular_food']);
                            $cell[$count]['is_eggless']=boolval($row['eggless']);
                            $cell[$count]['is_pickup']=boolval($row['pick_up_eligible']);
                            $cell[$count]['is_delivery']=boolval($row['delivery_eligible']);
                            $cell[$count]['item_status'] = boolval($row['menu_status']);
                            $cell[$count]['available_breakfast'] = boolval($row['available_at_breakfast']);
                            $cell[$count]['available_lunch'] = boolval($row['available_at_lunch']);
                            $cell[$count]['available_dinner'] = boolval($row['available_at_dinner']);
                            $cell[$count]['available_fullday'] = boolval($row['available_at_fullday']);
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
                $this->menuItemrepo->deleteByBUID($budID);
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

    /**
     * @param stdClass $object
     * @return array
     */
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
               'pincode'=>(int)$area->pincode,
               'city'=>(int)$area->city
           ];
       }
       $cuisineType=[];
       foreach ($object->cuisineType  as $key=>$cuisine) {
           $cuisineType[$key]=$cuisine->id;
       }

       $data =[
         'businessInfo'=>[
             'business_name'=>$object->businessName,
            'business_type_id'=> (int)$object->businessType,
            'status_id'=>(int) $object->status,
            'budget'=>(float)$object->budget,
            'parcel_charges'=>(float)$object->parcelCharges,
            'is_door_delivery'=> $object->doorDelivery=='true'?true:false,
            'minimum_delivery_amt'=>(float)$object->minimumDeliveryAmount,
            'delivery_fee'=> (float)$object->deliveryFee,
            'is_rail_delivery'=> $object->railDelivery=='true'?true:false,
            'minimum_rail_deli_amt'=>isset($object->minimumRailDeliveryAmount)?(float)$object->minimumRailDeliveryAmount:0,
            'is_pickup_available'=>  $object->pickupAvailable=='true'?true:false,
            'minimum_pickup_amt'=>isset($object->minimumPickupAmount)?(float)$object->minimumPickupAmount:0,
            'is_outdoor_catering'=>$object->outdoorCatering=='true'?true:false,
            'outdoor_catering_comments'=>isset($object->outdoorCateringComments)?(string)$object->outdoorCateringComments:'',
            'is_party_hall'=> $object->partyHall=='true'?true:false,
            'party_hall_comments'=>isset($object->partyHallComments)?(string)$object->partyHallComments:'',
            'is_buffet'=> $object->buffet=='true'?true:false,
            'is_midnight_buffet'=>$object->midnightBuffet=='true'?true:false,
            'is_wifi_available'=>$object->wifi=='true'?true:false,
            'is_children_play_area'=>$object->childrenPlayArea=='true'?true:false,
            'is_garden_restaurant'=>$object->gardenRestaurant=='true'?true:false,
            'is_roof_top'=> $object->roofTop=='true'?true:false,
            'is_valet_parking'=> $object->valetParking=='true'?true:false,
            'is_boarding'=> $object->boarding=='true'?true:false,
            'boarding_comments'=>isset($object->boardingComments)?(string)$object->boardingComments:'',
            'is_bar_attached'=> $object->barAttached=='true'?true:false,
            'is_highway_res'=> $object->highwayRestaurant=='true'?true:false,
            'highway_details'=> isset($object->highwayRestaurantDetails)?(string)$object->highwayRestaurantDetails:'',
            'website'=>isset($object->website)?$object->website:'',
            'business_about'=>isset($object->aboutBusiness)?$object->aboutBusiness:'',
            'ischeckout_enable'=> $object->checkOutEnable,
            'avg_delivery_time'=> isset($object->avgDeliveryTime)?$object->avgDeliveryTime:'',
             'is_halal'=>$object->halal=='true'?true:false,
             'is_barbecue'=>$object->bbq=='true'?true:false,
             'is_ac'=>$object->businessAC,
             'is_non_ac'=>$object->businessNonAC
             ],
          'address'=>[
              'city_id'=>(int)$object->city,
              'address_line_1'=>(string)$object->businessAddress1,
              'address_line_2'=>(string)$object->businessAddress2,
              'gps_latitude'=>$object->gpsLatitude,
              'gps_longitude'=>$object->gpsLongitude,
              'address_landmark'=>(string)$object->businessLandmark,
              'postal_code'=>(int)$object->postalCode,
              'mobile'=>(float)$object->businessMobile,
              'mobile2'=>empty($object->businessMobile2)?null:(float)$object->businessMobile2,
              'land_line'=>$object->landLine
          ],
           'user'=>[
               'first_name'=>$object->first_name,
                'last_name'=>$object->last_name,
                'email'=>$object->email,
                'mobile'=>(float)$object->mobile
           ],
          'payments'=>array_map(
              create_function('$value', 'return (int)$value;'),
              $object->payments
          ),
           'cuisineType'=>$cuisineType,
          'time' => $time,
           'delivery'=>$deliveryArea,
           'fileData'=>$object->fileData
        ];

       return $data;
   }

    /**
     * @param array $data
     * @param $slug
     */
    public function addOrUpdateHolidays(array $data,$slug)
    {
        $buId= $this->manageBusiness->findBusinessBySlug($slug);
        if(empty($data['start_time']) || empty($data['end_time'])) {
            $data['start_time']=null;
            $data['end_time']=null;
        }
        else{
            $data['start_time'] = $this->helper->timeConverter($data['start_time'], 'H:i:s');
            $data['end_time'] = $this->helper->timeConverter($data['end_time'], 'H:i:s');
        }
        if($data['id']==-1) {
            unset($data['id']);
            $data['business_info_id']=$buId->id;
            $this->holiday->create($data);
            return;
        }
        $this->holiday->update($data,(int)$data['id']);
    }

    /**
     * @param $slug
     * @return mixed
     */
    public function getCategoryBySlug($slug){
        $bu = $this->manageBusiness->findBusinessBySlug($slug);
       return $this->manageCategory->getCategoryByBusinessId($bu->id);
    }
    /**
     * @param $id
     * @return mixed
     */
    public function deleteHolidayById($id)
    {
        if($id!=-1) {
         return  $this->holiday->deleteById($id);
        }
    }

    /**
     * @param $slug
     * @param $data
     * @return bool
     */
    public function addPhotos($slug,$data)
    {
        $date = new DateTime();
        $this->imageHelper->make($data['dataURL'])
            ->resize(800, 600, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();})
            ->insert(public_path('assets/common/img/app/Logo.png'), 'bottom-left', -1, -30)
            ->save(public_path('uploads/' . $slug . '/photos/'.$slug.'_'.$data['picName'].'_'.$date->getTimestamp().'.png'));
        return true;
    }

    /**
     * @param $slug
     * @param $data
     * @return bool
     */
    public function deletePhoto($slug,$data)
    {
        $fileName = $data['fileName'].'.'.$data['type'];
        if($this->file->exists(public_path('uploads/' . $slug.'/photos/'.$fileName)))
        {
            $this->file->delete(public_path('uploads/' . $slug.'/photos/'.$fileName));
        }
        return true;
    }

    /**
     * @param $slug
     * @return array
     */
    public function getPhotos($slug)
    {
        if (!$this->file->isDirectory(public_path('uploads/' . $slug.'/photos'))) {
            $this->file->makeDirectory(public_path('uploads/' . $slug.'/photos'), 0775);
        }
        $files= $this->file->allFiles(public_path('uploads/' . $slug.'/photos'));
        $image =[];
        $i=0;
        foreach($files as $file)
        {
            $encode =$this->imageHelper->make($file->getRealPath())->encode('data-url',100);
            $image[$i]['dataURI']=$encode->getEncoded();
            $image[$i]['type']=$encode->extension;
            $image[$i]['size']=$encode->filesize();
            $image[$i]['fileName']=$encode->filename;
            $i++;
        }
       return $image;
    }

    /**
     * @param $slug
     * @return array
     * It will be used in restaurant profile page
     */
    public function getPhotosBySlug($slug){
        $filesInFolder= $this->file->files(public_path('uploads/' . $slug.'/photos'));
        $images=[];
        foreach($filesInFolder as $path)
        {
            $images[] = pathinfo($path);
        }
        return $images;

    }
}