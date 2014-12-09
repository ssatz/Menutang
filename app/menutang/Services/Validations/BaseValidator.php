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

use Illuminate\Validation\Factory;

abstract class BaseValidator
{
    protected $input;
    protected $errors;
    protected $validator;
    public function __construct(Factory $validator)
    {
        $this->validator = $validator;
    }
    public function with(array $input)
    {
        $this->input = $input;
        return $this;
    }

    public function passes()
    {
        $validation =  $this->validator->make($this->input, static::$rules);
        if ($validation->passes()) {
            return true;
        }
        $this->errors = $validation->messages();
        return false;
    }

    public function getErrors()
    {
        return $this->errors;
    }

}