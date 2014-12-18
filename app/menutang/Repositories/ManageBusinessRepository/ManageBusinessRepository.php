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


class ManageBusinessRepository extends BaseRepository implements IManageBusinessRepository
{

    /**
     * @var DatabaseManager
     */
    protected $dbManager;

    /**
     * @param businessInfo $managebusinesss
     * @param DatabaseManager $dbManager
     */
    function __construct(BusinessInfo $manageBusiness, DatabaseManager $dbManager)
    {
        parent::__construct($manageBusiness);
        $this->dbManager = $dbManager;

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
        $businessInfo = $this->model->with('address')->where('business_slug', '=', $slug)->first();
        return $businessInfo;
    }

    /**
     * @param array $data
     * @param string $slug
     * @return mixed
     */
    public function update(array $data, $slug)
    {
        return $this->model->where('business_slug', '=', $slug)->update($data);
    }

    /**
     * @return mixed
     */
    public function totalBusinesscount()
    {
        return $this->dbManager->table('business_info')->count();
    }


}