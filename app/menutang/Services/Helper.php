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
                    $results[$key] = $value;
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

}