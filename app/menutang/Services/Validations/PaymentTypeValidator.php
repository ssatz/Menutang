<?php
/*
 * This file(PaymentTypeValidator.php) is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Services\Validations;


class PaymentTypeValidator extends BaseValidator {

    protected static $rules=[
        'payment_code' => 'required|unique:cuisine_type,cuisine_code,<id>',
        'payment_description' => 'required|unique:cuisine_type,cuisine_description,<id>',
    ];
}