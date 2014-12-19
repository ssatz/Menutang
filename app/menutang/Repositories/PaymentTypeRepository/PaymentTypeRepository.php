<?php
/*
 * This file is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Repositories\PaymentTypeRepository;


use Payment;
use Repositories\BaseRepository;

class PaymentTypeRepository extends BaseRepository implements IPaymentTypeRepository
{
    public function __construct(Payment $payment)
    {
        parent::__construct($payment);
    }


    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->model->all();
    }
}