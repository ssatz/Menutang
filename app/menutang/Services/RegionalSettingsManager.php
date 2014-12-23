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


class RegionalSettingsManager
{

    public $errors;
    protected $city;
    protected $country;

    public function __construct(IManageCityRepository $city, IManageCountryRepository $country)
    {
        $this->errors = [];
        $this->city = $city;
        $this->country = $country;
    }

    public function insertCity(array $input)
    {
        $this->city->create($input);
    }

    public function getCityRelations()
    {
        return $this->city->getCityWithState();
    }

    public function getCity()
    {
        return $this->country->getCity();
    }

}