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


class MenuUploadValidator extends BaseValidator
{
    public static $rules = [
        'menu_upload' => 'required|mimes:xls,xlsx',
    ];
}