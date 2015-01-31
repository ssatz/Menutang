<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 12/22/2014
 * Time: 11:27 PM
 */

namespace Services;

use Repositories\ManageCityRepository\IManageCityRepository;
use Repositories\ManageCountryRepository\IManageCountryRepository;
use Illuminate\Database\DatabaseManager;
use Repositories\ManageDeliveryAreaRepository\IManageDeliveryAreaRepository;
use GuzzleHttp;
use Exception;


class RegionalSettingsManager
{

    /**
     * @var array
     */
    public $errors;
    /**
     * @var IManageCityRepository
     */
    protected $city;
    /**
     * @var DatabaseManager
     */
    protected $db;
    /**
     * @var IManageCountryRepository
     */
    protected $country;

    /**
     * @var IManagerDeliveryAreaRepository
     */
    protected $deliveryArea;

    /**
     * @param IManageCityRepository $city
     * @param IManageCountryRepository $country
     */
    public function __construct(IManageCityRepository $city,
                                IManageCountryRepository $country,
                                IManageDeliveryAreaRepository $deliveryAreaRepository,
                                DatabaseManager $databaseManager)
    {
        $this->errors = [];
        $this->city = $city;
        $this->country = $country;
        $this->deliveryArea = $deliveryAreaRepository;
        $this->db = $databaseManager;
    }

    /**
     * @param array $input
     */
    public function insertCity(array $input)
    {
        $this->city->create($input);
    }

    /**
     * @return mixed
     */
    public function getCityRelations()
    {
        return $this->city->getCityWithState();
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->country->getCity();
    }

    /**
     * @param array $input
     * @return bool
     * @throws Exception
     */
    public function updateCityStatus(array $input)
    {
        $this->db->beginTransaction();
        try {
            $id = $input['id'];
            $city = [];
            $city['city_status'] = $input['city_status'] == 'true' ? 1 : 0;
            $this->city->update($city, $id);

        } catch (Exception $e) {
            $this->db->rollback();
            throw new Exception($e->getMessage());
        }
        $this->db->commit();
        return true;
    }

    public function updateOrAddDeliveryArea($search)
    {
        $client = new  GuzzleHttp\Client();
        $client->setDefaultOption('verify', false);
        $res = $client->get('https://www.whizapi.com/api/v2/util/ui/in/indian-postal-codes.ashx?appkey=hv6r1slgqv97ihi3skkibbhj', ['query' => ['search' => $search]]);
        return $res->json();
    }
    /**
     * @param $pagination
     * @return mixed
     */
    public function getDeliveryArea($pagination)
    {
        return $this->deliveryArea->getAllPaginate($pagination);
    }

}