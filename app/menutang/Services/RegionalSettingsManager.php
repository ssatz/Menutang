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
use Repositories\ManageStateRepository\IManageStateRepository;
use Services\Validations\DeliveryAreaValidator;
use Services\Validations\CityValidator;
use GuzzleHttp;
use Exception;
use Carbon\Carbon;


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
     * @var IManageStateRepository
     */
    protected $state;

    protected $dateTime;
    /**
     * @var CityValidator
     */
    protected $cityValidation;

    /**
     * @var DeliveryAreaValidator
     */
    protected $deliveryAreaValidator;

    /**
     * @param IManageCityRepository $city
     * @param IManageCountryRepository $country
     */
    public function __construct(IManageCityRepository $city,
                                IManageCountryRepository $country,
                                IManageDeliveryAreaRepository $deliveryAreaRepository,
                                DeliveryAreaValidator $deliveryAreaValidator,
                                CityValidator $cityValidator,
                                IManageStateRepository $stateRepository,
                                Carbon $carbon,
                                DatabaseManager $databaseManager)
    {
        $this->errors = [];
        $this->city = $city;
        $this->country = $country;
        $this->deliveryArea = $deliveryAreaRepository;
        $this->db = $databaseManager;
        $this->state = $stateRepository;
        $this->cityValidation = $cityValidator;
        $this->deliveryAreaValidator = $deliveryAreaValidator;
        $this->dateTime=$carbon;
    }

    /**
     * @param array $input
     */
    public function addOrUpdateCity(array $input)
    {
        $data = [
            'id'=>(int)$input['id'],
            'state_id'=>trim($input['state_id']),
            'city_code'=>trim($input['city_code']),
            'city_description'=>trim(ucfirst($input['city_description'])),
            'city_status'=>$input['city_status'],
            'created_at'=>$this->dateTime->now(),
            'updated_at'=>$this->dateTime->now()
        ];
        $this->cityValidation->excludeId=(int)$input['id'];
        $this->cityValidation->with($data);
        if($this->cityValidation->passes()) {
            if($data['id']==-1) {
                unset($data['id']);
                $this->city->create($data);
                return true;
            }
            $this->city->update($data, $data['id']);
            return true;
        }
        $this->errors = $this->cityValidation->getErrors();
        return false;
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
     * @param $input
     */
    public function updateDeliveryArea($input)
    {
        $area = [
            'area' => $input['area'],
            'area_pincode' => $input['pincode'],
            'city_id' => $input['city_id']
        ];
        $this->deliveryAreaValidator->with($area);
        if ($this->deliveryAreaValidator->passes()){
             $this->deliveryArea->update($area, $input['delivery_id']);
            return true;
        }
        $this->errors = $this->deliveryAreaValidator->getErrors();
        return false;
    }

    /**
     * @param array $input
     * @return bool
     */
    public function addDeliveryArea(array $input)
    {
        $this->deliveryAreaValidator->with($input);
        if($this->deliveryAreaValidator->passes())
        {
             $this->deliveryArea->create($input);
            return true;
        }
        $this->errors = $this->deliveryAreaValidator->getErrors();
        return false;

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

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->state->getAllState();
    }

}