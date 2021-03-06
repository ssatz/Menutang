<?php
/*
 * This file is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Services\Cache;


interface ICacheService
{
    /**
     * @param $key
     * @return mixed
     */
    public function get($key);

    /**
     * @param $key
     * @param $value
     * @param null $minutes
     * @return mixed
     */
    public function put($key, $value, $minutes = null);

    /**
     * @param $key
     * @return bool
     */
    public function has($key);

    /**
     * @param $key
     * @return mixed
     */
    public function remove($key);

    /**
     * @param $key
     * @param $value
     * @return mixed
     */
    public function remember($key, $value);

    /**
     * @param $tag
     * @return mixed
     */
    public function flush($tag);

    /**
     * @param $tag
     * @return mixed
     */
    public function tag($tag);

    /**
     * @return mixed
     */
    public function flushAll();

}