<?php
/*
 * This file(TimeCategoryDTO.php) is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DTO;
use stdClass;
use DateTime;

class TimeCategoryDTO extends BaseDTO {
    public $time=[];
    public function __construct(stdClass $object)
    {
        foreach ($object->timeDay as $hr ) {
            $openTime = new DateTime($hr->openTime);
            $closeTime= new DateTime($hr->closeTime);
           $this->time =[
               'time_category_id'=>(int)$hr->timeCategory,
               'open_time'=>$openTime->format('H:i:s'),
               'close_time'=>$closeTime->format('H:i:s'),
               'day'=>get_object_vars($hr->day)
           ];
        }
    return $this;
    }
}