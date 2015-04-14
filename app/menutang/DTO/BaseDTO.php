<?php
/*
 * This file(BaseDTO.php) is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DTO;


abstract class BaseDTO {
    /**
     * @param $property
     * @param $value
     * @throws RuntimeException
     */
    public function __set($property, $value) {
        $this->throwUnlessPropertyExists($property);
        $this->throwUnlessCorrectType($property, $value);
        $this->throwUnlessCorrectSubclass($property, $value);

        $this->{$property} = $value;
    }

    /**
     * @param $property
     * @return mixed
     * @throws RuntimeException
     */
    public function __get($property) {
        $this->throwUnlessPropertyExists($property);

        return $this->{$property};
    }

    /**
     * @param $property
     * @throws RuntimeException
     */
    private function throwUnlessPropertyExists($property) {
        if (property_exists($this, $property) !== true) {
            throw new RuntimeException();
        }
    }

    /**
     * @param $property
     * @param $value
     * @throws RuntimeException
     */
    private function throwUnlessCorrectType($property, $value) {
        $typeUsedToBe = $this->getTypeUsedToBe($property);

        if ($typeUsedToBe !== "null") {
            $typeWantsToBe = $this->getTypeWantsToBe($value);

            if ($typeUsedToBe !== $typeWantsToBe) {
                throw new RuntimeException();
            }
        }
    }

    /**
     * @param $property
     * @return string
     */
    private function getTypeUsedToBe($property) {
        return $this->getTypeOf($this->{$property});
    }

    /**
     * @param $value
     * @return string
     */
    private function getTypeWantsToBe($value) {
        return $this->getTypeOf($value);
    }

    /**
     * @param $value
     * @return string
     */
    private function getTypeOf($value) {
        return strtolower(gettype($value));
    }

    /**
     * @param $property
     * @param $value
     * @throws RuntimeException
     */
    private function throwUnlessCorrectSubclass(
        $property,
        $value
    ) {
        $typeUsedToBe = $this->getTypeUsedToBe($property);

        if ($typeUsedToBe === "object") {
            $classUsedToBe = $this->getClassUsedToBe($property);

            if (!is_subclass_of($value, $classUsedToBe)) {
                throw new RuntimeException();
            }
        }
    }

    /**
     * @param $property
     * @return string
     */
    private function getClassUsedToBe($property) {
        return get_class($this->{$property});
    }
}