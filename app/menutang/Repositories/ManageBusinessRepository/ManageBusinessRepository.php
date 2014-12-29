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
     * @param businessInfo $managebusinesss
     * @param DatabaseManager $dbManager
     */
    function __construct(BusinessInfo $manageBusiness, DatabaseManager $dbManager, Helper $helper, ICacheService $cache)
    {
        parent::__construct($manageBusiness, $cache);
        $this->dbManager = $dbManager;
        $this->helper = $helper;

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
        $businessInfo = $this->model->with('address', 'payment')->where('business_slug', '=', $slug)->first();
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
        $result = $this->helper->match($input, ['business_info', 'business_address']);
        $businessInfo = $this->model->where('business_slug', '=', $slug)->first();
        $this->model->where('business_slug', '=', $slug)->update($result['business_info']);
        $this->model->find($businessInfo->id)->address()->update($result['business_address']);
        $businessInfo->payment()->sync($input['payments']);
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
     * @param array $input
     * @return mixed
     */
    public function insert(array $input)
    {
        $businessInfo = new $this->model;
        $businessInfo->business_name = $input['business_name'];
        $businessInfo->budget = $input['budget'];
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
        $businessInfo->ischeckout_enable = $input['avg_delivery_time'];
        $businessInfo->status_id = $input['status_id'];
        $businessInfo->save();
        $slug = $this->slug($input['business_name']);
        if (!empty($this->findBusinessBySlug($slug))) {
            $slug = $slug . '_' . $businessInfo->id;
        }
        $businessInfo->fill(['business_slug' => $slug]);
        $businessInfo->save();

    }
}