<?php
/*
 * This file(CategoryValidator.php) is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Services\Validations;


class CategoryValidator extends BaseValidator
{
    /**
     * @var array
     */
    public static $rules = [
        'category_name' => 'required|max:255|unique:menu_category',
    ];
}