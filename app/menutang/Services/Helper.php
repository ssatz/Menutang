<?php
/*
 * This file is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Services;


use Illuminate\Support\Facades\Schema;
use DateTime;

class Helper
{
    /**
     * Match Request Input with Respective tables
     * @param array $inputs
     * @param array $tables
     * @return array
     */
    public function match(array $inputs, array $tables)
    {
        $results = [];
        $data = [];

        foreach ($tables as $table) {
            $columns = Schema::getColumnListing($table);
            foreach ($inputs as $key => $value) {
                if (in_array($key, $columns)) {
                    $i =is_numeric($value)?(float)$value:$value;
                    $results[$key] = $i;
                }
            }
            $columns = [];
            $data[$table] = $results;
            $results = [];
        }
        return $data;
    }

    /**
     * @param $time
     * @param $format
     * @return string
     */
    public function timeConverter($time, $format)
    {
        $time = new DateTime($time);
        return $time->format($format);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function replaceSpace($data)
    {
        return str_replace(' ', '-',ucfirst(strtolower($data)));
    }

    /**
     * @param $string
     * @return array
     */
    public function convertStrToArray($string)
    {
        $string =rtrim($string,',');
        $string =ltrim($string,',');
        $string=explode(',',$string);
        return (array)$string;
    }

}