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

    /**
     * @param $input
     */
    public function updateDeliveryArea($input)
    {
        $area =[
            'area'=> $input['area'],
            'area_pincode'=>$input['pincode'],
            'city_id'=>$input['city_id']
        ];
        if($input['action']=='update')
        {
           return $this->deliveryArea->update($area,$input['delivery_id']);
        }
    }

    public function addDeliveryArea(array $input)
    {
        return $this->deliveryArea->create($input);
    }

    /**
     * @param $search
     * @return mixed
     */
    public function getDeliveryAreaPincode($search)
    {
        $client = new  GuzzleHttp\Client();
        $client->setDefaultOption('verify', false);
        $res = $client->get('http://www.getpincode.info/api/pincode', ['query' => ['q' => $search]]);
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