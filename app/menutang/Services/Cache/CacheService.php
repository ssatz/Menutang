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

use Illuminate\Cache\CacheManager;

class CacheService implements ICacheService
{

    /**
     * @var Illuminate\Cache\CacheManager
     */
    protected $cache;


    /**
     * @var integer
     */
    protected $minutes;

    /**
     * @var string
     */
    protected $tag;

    /**
     * Construct
     *
     * @param Illuminate\Cache\CacheManager $cache
     * @param string $tag
     * @param integer $minutes
     */
    public function __construct(CacheManager $cache, $minutes = 60)
    {
        $this->cache = $cache;
        $this->minutes = $minutes;
    }

    /**
     * @param $tag
     * @return $this
     */
    public function tag($tag)
    {
        $this->tag = $tag;
        return $this;
    }

    /**
     * Get
     *
     * @param string $key
     * @return mixed
     */
    public function get($key)
    {
        return $this->cache->tags($this->tag)->get($key);

    }

    /**
     * Put
     *
     * @param string $key
     * @param mixed $value
     * @param integer $minutes
     * @return mixed
     */
    public function put($key, $value, $minutes = null)
    {
        if (is_null($minutes)) {
            $minutes = $this->minutes;
        }

        return $this->cache->tags($this->tag)->put($key, $value, $minutes);
    }

    /**
     * Has
     *
     * @param string $key
     * @return bool
     */
    public function has($key)
    {
        return $this->cache->tags($this->tag)->has($key);
    }


    /**
     * @param $key
     * @return mixed
     */
    public function remove($key)
    {
        return $this->cache->forget($key);
    }

    /**
     * @param $key
     * @param $value
     * @return mixed
     */
    public function remember($key, $value)
    {
        return $this->cache->remember($key, $this->minutes, function () use ($value) {
            return $value;
        });
    }

    /**
     * @param $tag
     */
    public function flush($tag)
    {
        $this->cache->tags($this->tag)->flush();
    }

    /**
     * Flush all Caches
     */
    public function flushAll()
    {
        $this->cache->flush();
    }
}