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
     * @param IManageCityRepository $city
     * @param IManageCountryRepository $country
     */
    public function __construct(IManageCityRepository $city,
                                IManageCountryRepository $country,
                                DatabaseManager $databaseManager)
    {
        $this->errors = [];
        $this->city = $city;
        $this->country = $country;
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

}