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
use Services\Helper;
use DeliveryArea;
use BusinessAddress;
use BusinessHours;
use BusinessPhoto;
use Intervention\Image\ImageManager;
use Illuminate\Filesystem\Filesystem;
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
    function __construct(BusinessInfo $manageBusiness, DatabaseManager $dbManager,
                         Helper $helper, ICacheService $cache,ImageManager $image,Filesystem $filesystem)
    {
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
        $input['cuisine_type_id'] = $input['business_type_id']==1?$input['cuisine_type_id']:null;
        $key = md5('slug.' . $slug);
        $this->cache->remove($key);
        $result = $this->helper->match($input, ['business_info', 'business_address','business_hours']);
        $businessInfo = $this->model->where('business_slug', '=', $slug)->first();
        $this->model->where('business_slug', '=', $slug)->update($result['business_info']);
        $this->model->find($businessInfo->id)->address()->update($result['business_address']);
        $businessInfo->payment()->sync($input['payments']);
        if(!$this->fileHelper->isDirectory(public_path('uploads/'.$slug))) {
            $this->fileHelper->makeDirectory(public_path('uploads/' . $slug), 0775);
        }

        if(isset($input['fileToUpload'])) {
            $this->fileHelper->delete(public_path('uploads/' . $slug.'/logo.png'));
            $this->imageHelper->make($input['fileToUpload']->getRealPath())->resize(75, 75)->save(public_path('uploads/' . $slug . '/logo.png'));
        }
        $deliveryAreaId = [];
       /* foreach ($input['delivery_area'] as $area) {
            $deliveryArea = DeliveryArea::Where('area','=',strtolower($area['area']))->get();
            array_push($deliveryAreaId, $deliveryArea->id);
        }
        $businessInfo->deliveryArea()->attach($deliveryAreaId);*/
        foreach ($input['hours'] as $key => $value) {
            $buhr = $this->model->find($businessInfo->id)->businessHours()->where('day','=',$key)->first();
            $buhr->business_info_id = $businessInfo->id;
            if (!isset($input['hours'][$key]['is_closed'])) {
                    $buhr->open_time = isset($input['hours'][$key]['open_time']) ? $this->helper->timeConverter($input['hours'][$key]['open_time'], "H:i:s") : null;
                    $buhr->close_time = isset($input['hours'][$key]['close_time']) ? $this->helper->timeConverter($input['hours'][$key]['close_time'], "H:i:s") : null;
            }
            $buhr->is_closed = isset($input['hours'][$key]['is_closed']) ? (int)$input['hours'][$key]['is_closed'] : 0;
            $buhr->save();

        }
        return;
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
    public function findByLocality($locality)
    {
       $businessInfo=  $this->model->with('businessHours','cuisineType','address')->whereHas('address',function($q) use($locality)
       {
            $q->whereHas('city',function($q) use($locality)
            {
                $q->where('city_description','=',$locality);
            });
       })->remember(10)->paginate(15);
        return $businessInfo;
    }

    /**
     * @param $locality
     * @param $area
     * @return mixed
     */
    public function findByArea($locality, $area)
    {
        $area = explode('-',$area);
        $businessInfo=  $this->model->with('businessHours','cuisineType','address','deliveryArea')->whereHas('address',function($q) use($locality)
        {
            $q->whereHas('city',function($q) use($locality)
            {
                $q->where('city_description','=',$locality);
            });
        })->whereHas('deliveryArea',function($q) use($area)
        {
            $q->where('area','LIKE','%'.$area[0].'%');
        }
        )->remember(10)->paginate(15);
        return $businessInfo;
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
        $businessInfo = new $this->model;
        $businessInfo->business_name = $input['business_name'];
        $businessInfo->budget = $input['budget'];
        /*Always Restaurants should come First */
        $businessInfo->business_type_id = $input['business_type_id'];
        $businessInfo->is_outdoor_catering = $input['is_outdoor_catering'];
        $businessInfo->outdoor_catering_comments = $input['outdoor_catering_comments'];
        $businessInfo->is_door_delivery = $input['is_door_delivery'];
        $businessInfo->minimum_delivery_amt = $input['is_door_delivery'] ? $input['minimum_delivery_amt'] : 0.00;
        $businessInfo->is_rail_delivery = $input['is_rail_delivery'];
        $businessInfo->minimum_rail_deli_amt = $input['is_rail_delivery'] ? $input['minimum_rail_deli_amt'] : 0.00;
        $businessInfo->is_pickup_available = $input['is_pickup_available'];
        $businessInfo->minimum_pickup_amt = $input['is_pickup_available'] ? $input['minimum_pickup_amt'] : 0.00;
        $businessInfo->is_party_hall = $input['is_party_hall'];
        $businessInfo->party_hall_comments = $input['party_hall_comments'];
        $businessInfo->is_buffet = $input['is_buffet'];
        $businessInfo->is_midnight_buffet = $input['is_midnight_buffet'];
        $businessInfo->is_wifi_available = $input['is_wifi_available'];
        $businessInfo->is_children_play_area = $input['is_children_play_area'];
        $businessInfo->is_garden_restaurant = $input['is_garden_restaurant'];
        $businessInfo->is_roof_top = $input['is_roof_top'];
        $businessInfo->is_valet_parking = $input['is_valet_parking'];
        $businessInfo->is_boarding = $input['is_boarding'];
        $businessInfo->boarding_comments = $input['boarding_comments'];
        $businessInfo->is_bar_attached = $input['is_bar_attached'];
        $businessInfo->is_highway_res = $input['is_highway_res'];
        $businessInfo->highway_details = $input['highway_details'];
        $businessInfo->website = $input['website'];
        $businessInfo->avg_delivery_time = $input['avg_delivery_time'];
        $businessInfo->ischeckout_enable = $input['ischeckout_enable'];
        $businessInfo->status_id = $input['status_id'];
        $businessInfo->save();
        $slug = $this->slug($input['business_name']);
        if (!empty($this->findBusinessBySlug($slug))) {
            $slug = $slug . '-' . $businessInfo->id;
        }
        $buuniqueId = $this->dbManager->table('business_type')->where('id', $input['business_type_id'])->pluck('business_code');
        $buuniqueId =$buuniqueId.'00000'.$businessInfo->id;

        $businessInfo->fill(['business_slug' => $slug,'business_unique_id'=>$buuniqueId]);
        $businessInfo->save();
        if(!$this->fileHelper->isDirectory(public_path('uploads/'.$slug))) {
            $this->fileHelper->makeDirectory(public_path('uploads/' . $slug), 0775);
        }
        $this->imageHelper->make($input['fileToUpload']->getRealPath())->resize(75, 75)->save(public_path('uploads/'.$slug.'/logo.png'));

        $image = new BusinessPhoto();
        $image->business_info_id =$businessInfo->id;
        $image->image_name = 'logo.png';


        $businessInfo->businessPhoto()->save($image);

        $address = new BusinessAddress();
        $address->city_id = $input['city_id'];
        $address->address_line_1 = $input['address_line_1'];
        $address->address_line_2 = $input['address_line_2'];
        $address->address_landmark = $input['address_landmark'];
        $address->address_gps_location = $input['address_gps_location'];
        $address->postal_code = $input['postal_code'];
        $businessInfo->address()->save($address);

        $businessInfo->payment()->attach($input['payments']);

        foreach($input['hours'] as $key => $value)
        {
            if(isset($input['hours'][$key]['available'])) {
                $hours = new BusinessHours([
                    'business_info_id'=>$businessInfo->id,
                    'time_category_id'=>(int)$input['hours'][$key]['available'],
                    'open_time'=>$this->helper->timeConverter($input['hours'][$key]['open_time'], "H:i:s"),
                    'close_time'=>$this->helper->timeConverter($input['hours'][$key]['close_time'], "H:i:s"),
                ]);
                $businessInfo->businessHours()->save($hours);
                $weekDays=[];
                foreach(WeekdaysEnum::toArray() as $dayKey => $dayValue)
                {
                    if(isset($input['hours'][$key][strtolower($dayKey)])) {
                        $weekDays[] = $dayValue;
                    }
                }
                $hours->weekDays()->attach($weekDays);
            }
        }

        if(!is_null($input['cuisines_types'])) {
            $businessInfo->cuisineType()->attach($input['cuisines_types']);
        }

        $deliveryAreaId = [];
        foreach ($input['delivery_area'] as $area) {
            $deliveryArea = DeliveryArea::find($area['id']);
            if(is_null($deliveryArea)) {
                $deliveryArea = new DeliveryArea();
                $deliveryArea->area =(string)$area['area'];
                $deliveryArea->area_pincode = (int)$area['pincode'];
                $deliveryArea->city_id = (int)$address->city_id;
                $deliveryArea->save();
            }
            array_push($deliveryAreaId, $deliveryArea->id);

        }
        $businessInfo->deliveryArea()->attach(array_unique($deliveryAreaId));
    }
}