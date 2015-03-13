<?php
/*
 * This file(CustomValidator.php) is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Services\Validations;
use Illuminate\Validation\Validator;


class CustomValidator extends Validator {
    /**
     * @var array
     */
    private $message = array(
        "mobile" => "Please enter a valid mobile number"
    );

    /**
     * @param \Symfony\Component\Translation\TranslatorInterface $translator
     * @param array $data
     * @param array $rules
     * @param array $messages
     * @param array $customAttributes
     */
    public function __construct( $translator, $data, $rules, $messages = array(), $customAttributes = array() ) {
        parent::__construct( $translator, $data, $rules, $messages, $customAttributes );

        $this->setCustomMessage();
    }

    /**
     *
     */
    protected function setCustomMessage() {
        $this->setCustomMessages( $this->message );
    }

    /**
     * @param $attribute
     * @param $value
     * @return bool
     */
    protected function validateMobile( $attribute, $value ) {
        return (bool) preg_match("/^[789]\d{9}$/", $value );
    }
}