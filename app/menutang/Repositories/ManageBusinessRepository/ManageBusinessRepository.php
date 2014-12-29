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


}