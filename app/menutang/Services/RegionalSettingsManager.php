<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 12/22/2014
 * Time: 11:27 PM
 */

namespace Services;

use Repositories\ManageCityRepository\IManageCityRepository;


class RegionalSettingsManager
{

    public $errors;
    protected $city;

    public function __construct(IManageCityRepository $city)
    {
        $this->errors = [];
        $this->city = $city;
    }

    public function insertCity(array $input)
    {
        $this->city->create($input);
    }

    public function getCityRelations()
    {
        return $this->city->getCityWithState();
    }

}