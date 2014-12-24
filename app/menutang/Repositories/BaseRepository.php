<?php namespace Repositories;

/*
 * This file is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

abstract class BaseRepository
{
    /**
     * @var
     */
    protected $model;
    /**
     * @var
     */
    protected $cache;

    /**
     * @param $model
     * @param $cache
     */
    public function __construct($model, $cache)
    {
        $this->model = $model;
        $this->cache = $cache;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        $key = md5($this->getObjectName() . '.all');
        $this->cache->remove($key);
        return $this->model->create($data);
    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        $key = md5($this->getObjectName() . '.all');
        if ($this->cache->has($key)) {
            $this->cache->get($key);
        }
        $all = $this->model->all();
        $this->cache->put($key, $all);
        return $all;
    }

    /**
     * @return string
     */
    protected function getObjectName()
    {
        return get_class($this->model);
    }

    /**
     * Make a string "slug-friendly" for URLs
     * @param  string $string Human-friendly tag
     * @return string       Computer-friendly tag
     */
    protected function slug($string)
    {
        return filter_var(str_replace(' ', '-', strtolower(trim($string))), FILTER_SANITIZE_URL);
    }


}