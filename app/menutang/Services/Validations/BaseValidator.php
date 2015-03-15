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
    /**
     * @var array
     */
    protected static $messages = [];
    /**
     * @var
     */
    protected $input;
    /**
     * @var
     */
    protected $errors;
    /**
     * @var Factory
     */
    protected $validator;

    /**
     * @param Factory $validator
     */
    public function __construct(Factory $validator)
    {
        $this->validator = $validator;
    }

    /**
     * @param array $input
     * @return $this
     */
    public function with(array $input)
    {
        $this->input = $input;
        return $this;
    }

    /**
     * @return bool
     */
    public function passes()
    {
        $validation = $this->validator->make($this->input, static::$rules, static::$messages);
        if ($validation->passes()) {
            return true;
        }
        $this->errors = $validation->messages();
        return false;
    }

    /**
     * @return mixed
     */
    public function getErrors()
    {
        return $this->errors;
    }

}