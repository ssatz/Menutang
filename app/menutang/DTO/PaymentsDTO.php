<?php
/*
 * This file(PaymentsDTO.php) is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DTO;
use stdClass;


class PaymentsDTO extends BaseDTO {
 public $payments;
    public function  __construct(stdClass $object)
    {
        $this->payments=$object->payments;
        return $this;
    }
}