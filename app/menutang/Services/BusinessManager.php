<?php
/*
 * This file is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Services;

use Illuminate\Database\DatabaseManager;
use Repositories\ManageBusinessRepository\IManageBusinessRepository;
use Services\Cache\ICacheService;
use Services\Validations\BusinessValidator;


class BusinessManager
{

    public $errors;
    /**
     * @var IManageRestaurantRepository
     */
    protected $manageBusiness;
    /**
     * @var ICacheService
     */
    protected $cacheService;
    protected $db;
    protected $validations;

    /**
     * @param IManageBusinessRepository $manageRestaurant
     * @param ICacheService $cacheService
     */
    public function __construct(IManageBusinessRepository $manageBusiness,
                                ICacheService $cacheService,
                                BusinessValidator $businessValidator,
                                DatabaseManager $databaseManager)
    {
        $this->manageBusiness = $manageBusiness;
        $this->cacheService = $cacheService;
        $this->validations = $businessValidator;
        $this->db = $databaseManager;
    }

    /**
     * @return mixed
     */
    public function getAllBusiness()
    {
        $restaurants = [];
        $restaurants[0] = $this->manageBusiness->getAllBusiness();
        $restaurants[1] = $this->manageBusiness->totalBusinesscount();
        return $restaurants;
    }

    /**
     * @param $slug
     * @return mixed
     */
    public function editBusiness($slug)
    {
        return $this->manageBusiness->findBusinessBySlug($slug);
    }

    /**
     * @param array $input
     * @param $slug
     */
    public function updateBusiness(array $input, $slug)
    {
        $this->validations->with($input);
        if ($this->validations->passes()) {
            $this->db->beginTransaction();
            try {
                $this->manageBusiness->update($input, $slug);
            } catch (\Exception $e) {
                $this->db->rollback();

            }
            $this->db->commit();
            return true;
        }
        $this->errors = $this->validations->getErrors();
        return false;
    }
}