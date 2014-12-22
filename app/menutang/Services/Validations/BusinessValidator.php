<?php
/*
 * This file is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Services\Validations;


class BusinessValidator extends BaseValidator
{
    /**
     * @var array
     */
    public static $rules = [
        'business_name' => 'required|max:255',
        'minimum_delivery_amt' => ['required', 'Regex:/^[0-9]+(\.[0-9]{1,2})?$/'],
        'website' => 'url',
        'address_line_1' => 'required',
        'city_id' => 'required',
        'payments' => 'required'
    ];
}