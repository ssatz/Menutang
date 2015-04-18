<?php
/*
 * This file is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Repositories\ManageBusinessRepository;


use BusinessInfo;
use Illuminate\Database\DatabaseManager;
use Repositories\BaseRepository;
use Services\Cache\ICacheService;
use Services\DeliveryOptionEnum;
use Services\Helper;
use DeliveryArea;
use BusinessAddress;
use BusinessHours;
use BusinessPhoto;
use Intervention\Image\ImageManager;
use Illuminate\Filesystem\Filesystem;
use Services\SearchEnum;
use Services\WeekdaysEnum;


class ManageBusinessRepository extends BaseRepository implements IManageBusinessRepository
{

    /**
     * @var DatabaseManager
     */
    protected $dbManager;

    /**
     * @var Helper
     */
    protected $helper;
    /**
     * @var ImageManager
     */
    protected $imageHelper;
    /**
     * @var Filesystem
     */
    protected $fileHelper;

    /**
     * @param businessInfo $managebusinesss
     * @param DatabaseManager $dbManager
     */
  public  function __construct(BusinessInfo $manageBusiness, DatabaseManager $dbManager,
                         Helper $helper, ICacheService $cache,ImageManager $image,Filesystem $filesystem)
    {
        $cache->tag(get_class($manageBusiness));
        parent::__construct($manageBusiness, $cache);
        $this->dbManager = $dbManager;
        $this->helper = $helper;
        $this->imageHelper =$image;
        $this->fileHelper =$filesystem;
    }

    /**
     * @return mixed
     */
    public function getAllBusiness()
    {
        $businessInfo = $this->dbManager->table('business_info')->select('business_unique_id', 'business_name', 'business_type', 'status_code', 'ischeckout_enable', 'business_slug', 'city_description', 'business_info.created_at')
            ->leftjoin('business_type', 'business_info.business_type_id', '=', 'business_type.id')
            ->leftjoin('business_address', 'business_info.id', '=', 'business_address.business_info_id')
            ->leftjoin('city', 'city.id', '=', 'city_id')
            ->leftjoin('status', 'status.id', '=', 'status_id')
            ->leftjoin('business_users', 'business_info.id', '=', 'business_users.id')
            ->paginate(20);

        return $businessInfo;
    }

    /**
     * @param $slug
     */
    public function findBusinessBySlug($slug)
    {
        $key = md5('slug.' . $slug);
        if ($this->cache->has($key)) {
            return $this->cache->get($key);
        }
        $businessInfo = $this->model->with('address.city', 'payment','deliveryArea','cuisineType','businessHours.timeCategory','businessHours.weekDays')->where('business_slug', '=', $slug)->first();
        $this->cache->put($key, $businessInfo);
        return $businessInfo;
    }

    /**
     * @param array $data
     * @param string $slug
     * @return mixed
     */
    public function update(array $input, $slug)
    {
        $key = md5('slug.' . $slug);
        $this->cache->remove($key);
        $result = $this->helper->match($input, ['business_info', 'business_address','business_hours']);
        $businessInfo = $this->model->where('business_slug', '=', $slug)->first();
        $this->model->where('business_slug', '=', $slug)->update($result['business_info']);
        $this->model->find($businessInfo->id)->address()->update($result['business_address']);
        $businessInfo->payment()->attach($input['payments']);
        if(!$this->fileHelper->isDirectory(public_path('uploads/'.$slug))) {
            $this->fileHelper->makeDirectory(public_path('uploads/' . $slug), 0775);
        }

        if(isset($input['fileToUpload'])) {
            $this->fileHelper->delete(public_path('uploads/' . $slug.'/logo75.png'));
            $this->fileHelper->delete(public_path('uploads/' . $slug.'/logo220.png'));
            $this->imageHelper->make($input['fileToUpload']->getRealPath())->resize(75, 75)->save(public_path('uploads/'.$slug.'/logo75.png'));
            $this->imageHelper->make($input['fileToUpload']->getRealPath())->resize(220, 220)->save(public_path('uploads/'.$slug.'/logo220.png'));
        }
        if(!empty($input['hour_delete']))
        {
            $deleteBUHrs = ltrim($input['hour_delete'], ',');
            BusinessHours::destroy($deleteBUHrs);
        }
        foreach($input['hours'] as $key => $value)
        {

            if(isset($input['hours'][$key]['available'])) {
                if ($input['hours'][$key]['available'] == -1) {
                    $hours = new BusinessHours([
                        'business_info_id' => $businessInfo->id,
                        'time_category_id' => (int)$input['hours'][$key]['time'],
                        'open_time' => $this->helper->timeConverter($input['hours'][$key]['open_time'], "H:i:s"),
                        'close_time' => $this->helper->timeConverter($input['hours'][$key]['close_time'], "H:i:s"),
                    ]);
                    $businessInfo->businessHours()->save($hours);
                    $weekDays = [];
                    foreach (WeekdaysEnum::toArray() as $dayKey => $dayValue) {
                        if (isset($input['hours'][$key][strtolower($dayKey)])) {
                            $weekDays[] = $dayValue;
                        }
                    }
                    $hours->weekDays()->sync($weekDays);
                }
                else{
                    $data = [
                        'open_time' => $this->helper->timeConverter($input['hours'][$key]['open_time'], "H:i:s"),
                        'close_time' => $this->helper->timeConverter($input['hours'][$key]['close_time'], "H:i:s"),
                    ];
                    $weekDays = [];
                    foreach (WeekdaysEnum::toArray() as $dayKey => $dayValue) {
                        if (isset($input['hours'][$key][strtolower($dayKey)])) {
                            $weekDays[] = $dayValue;
                        }
                    }
                     BusinessHours::where('id','=',$input['hours'][$key]['available'])->update($data);
                     BusinessHours::find($input['hours'][$key]['available'])->weekDays()->sync($weekDays);

                }
            }
        }
        if(isset($input['cuisines_types']))
        if(!is_null($input['cuisines_types'])) {
            $businessInfo->cuisineType()->sync($input['cuisines_types'],false);
        }

        $deliveryAreaId = [];
        foreach ($input['delivery_area'] as $area) {
            $deliveryArea = DeliveryArea::find($area['id']);
            if(is_null($deliveryArea)) {
                $deliveryArea = new DeliveryArea();
                $deliveryArea->area =(string)$area['area'];
                $deliveryArea->area_pincode = (int)$area['pincode'];
                $deliveryArea->city_id = (int)$input['city_id'];;
                $deliveryArea->save();
            }
            array_push($deliveryAreaId, $deliveryArea->id);

        }
        $businessInfo->deliveryArea()->sync(array_unique($deliveryAreaId),false);
    }

    /**
     * @return mixed
     */
    public function totalBusinesscount()
    {
        $key = md5('totalbusiness');
        if ($this->cache->has($key)) {
            return $this->cache->get($key);

        }
        $count = $this->dbManager->table('business_info')->count();
        $this->cache->put($key, $count);
        return $count;
    }

    /**
     * @param $locality
     * @return mixed
     */
    public function findByLocality($locality,$business=null,$serviceType=null,$cuisineType=null,$paymentType=null)
    {

       $businessInfo=  $this->model->with('businessHours','business','cuisineType','address')->whereHas('address',function($q) use($locality)
       {
            $q->whereHas('city',function($q) use($locality)
            {
                $q->where('city_description','=',$locality);
            });
       })->whereHas('business',function($q)use($business,$cuisineType)
       {
           if(is_null($business) || $business==SearchEnum::ALL()) {
              return $q;
           }
           else{
               $q->where('business_code','=',$business);
           }

       })->whereHas('payment',function($q)use($paymentType){
           if(is_null($paymentType) || $paymentType==SearchEnum::ALL()) {
               return $q;
           }
           else{
              $q->whereIn('payment_code',[$paymentType]);
           }
        });
        if(!is_null($serviceType) && DeliveryOptionEnum::DELIVERY ==ucfirst(strtolower($serviceType)) ){
            $businessInfo = $businessInfo->where('is_door_delivery',true)->where('is_pickup_available',false);
        }
        if(!is_null($serviceType) && DeliveryOptionEnum::PICKUP == ucfirst(strtolower($serviceType)) ){
            $businessInfo = $businessInfo->where('is_door_delivery',false)->where('is_pickup_available',true);
        }
        return $businessInfo->remember(10)->paginate(15);
    }

    /**
     * @param $locality
     * @param $area
     * @return mixed
     */
    public function findByArea($locality, $area,$business=null,$serviceType=null,$cuisineType=null,$paymentType=null)
    {
        $area = explode('-',$area);
        $businessInfo=  $this->model->with('businessHours','business','cuisineType','address','deliveryArea')
            ->whereHas('address',function($q) use($locality)
        {
            $q->whereHas('city',function($q) use($locality)
            {
                $q->where('city_description','=',$locality);
            });
        })->whereHas('deliveryArea',function($q) use($area)
        {
            $q->where('area','LIKE','%'.$area[0].'%');
        })->whereHas('business',function($q)use($business,$cuisineType)
            {
                if(is_null($business) || $business==SearchEnum::ALL()) {
                    return $q;
                }
                else{
                    $q->where('business_code','=',$business);
                }

            })->whereHas('payment',function($q)use($paymentType){
                if(is_null($paymentType) || $paymentType==SearchEnum::ALL()) {
                    return $q;
                }
                else{
                    $q->whereIn('payment_code',[$paymentType]);
                }
            });
        if(!is_null($serviceType) && DeliveryOptionEnum::DELIVERY ==ucfirst(strtolower($serviceType)) ){
            $businessInfo = $businessInfo->where('is_door_delivery',true)->where('is_pickup_available',false);
        }
        if(!is_null($serviceType) && DeliveryOptionEnum::PICKUP == ucfirst(strtolower($serviceType)) ){
            $businessInfo = $businessInfo->where('is_door_delivery',false)->where('is_pickup_available',true);
        }
        return $businessInfo->remember(10)->paginate(15);
    }

    /**
     * @param $name
     * @return mixed
     */
    public function findByName($name)
    {
        // TODO: Implement findByName() method.
    }
    /**
     * @param array $input
     * @return mixed
     */
    public function insert(array $input)
    {
        $businessInfo = $this->model->create($input['businessInfo']);
        $slug = $this->slug($input['businessInfo']['business_name']);
        if (!empty($this->findBusinessBySlug($slug))) {
            $slug = $slug . '-' . $businessInfo->id;
        }
        $buUniqueId = $this->dbManager->table('business_type')->where('id', (int)$input['businessInfo']['business_type_id'])->pluck('business_code');
        $buUniqueId = $buUniqueId . '00000' . $businessInfo->id;

        $businessInfo->fill(['business_slug' => $slug, 'business_unique_id' => $buUniqueId]);
        $businessInfo->save();
        $businessInfo->cuisineType()->attach($input['cuisineType']);
        $address = new BusinessAddress();
        $address->city_id = $input['address']['city_id'];
        $address->address_line_1 = $input['address']['address_line_1'];
        $address->address_line_2 = $input['address']['address_line_2'];
        $address->address_landmark = $input['address']['address_landmark'];
        $address->gps_latitude = $input['address']['gps_latitude'];
        $address->gps_longitude = $input['address']['gps_longitude'];
        $address->postal_code = $input['address']['postal_code'];
        $address->mobile = $input['address']['mobile'];
        $businessInfo->address()->save($address);
        $businessInfo->payment()->attach($input['payments']);
        foreach ($input['time'] as $key => $value) {
            $hours = new BusinessHours([
                'business_info_id' => $businessInfo->id,
                'time_category_id' => $value['time_category_id'],
                'open_time' => $value['open_time'],
                'close_time' => $value['close_time']
            ]);
            $businessInfo->businessHours()->save($hours);
            $hours->weekDays()->attach($value['day']);
        }

        if (!$this->fileHelper->isDirectory(public_path('uploads/' . $slug))) {
            $this->fileHelper->makeDirectory(public_path('uploads/' . $slug), 0775);
        }
        $this->imageHelper->make($input['fileData']->dataURL)->resize(75, 75)->save(public_path('uploads/' . $slug . '/logo75.png'));
        $this->imageHelper->make($input['fileData']->dataURL)->resize(220, 220)->save(public_path('uploads/' . $slug . '/logo220.png'));

        $image = new BusinessPhoto();
        $image->business_info_id = $businessInfo->id;
        $image->image_name = 'logo75.png';
        $image->save();
        $deliveryAreaId = [];
        if (count($input['delivery']) > 0) {
            foreach ($input['delivery'] as $area) {
                $deliveryArea = DeliveryArea::where('area', $area['area'])->where('area_pincode', (int)$area['pincode'])->first();
                if (is_null($deliveryArea)) {
                    $deliveryArea = new DeliveryArea();
                    $deliveryArea->area = (string)$area['area'];
                    $deliveryArea->area_pincode = (int)$area['pincode'];
                    $deliveryArea->city_id = (int)$area['city'];
                    $deliveryArea->save();
                }
                array_push($deliveryAreaId, $deliveryArea->id);

            }
            $businessInfo->deliveryArea()->attach(array_unique($deliveryAreaId));
        }
    }
}