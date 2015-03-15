<?php namespace Repositories;

/*
 * This file is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
use RuntimeException;
use NumberFormatter;
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
    public function __construct($model, $cache = null, Array $properties = [])
    {
        $this->model = $model;
        $this->cache = $cache;
        foreach ($properties as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * @param $key
     * @return mixed
     */
    public function __get($key)
    {
        $method = 'get' .ucfirst($key);
        if (method_exists($this, $method)) {
            return $this->$method();
        }
        throw new RuntimeException("Cannot get property '${key}'.");
    }

    /**
     * @param $key
     * @param $value
     */
    public function __set($key, $value)
    {
        $method = 'set' .ucfirst($key);
        if (method_exists($this, $method)) {
            $this->$method($value);
            return;
        }
        throw new RuntimeException("Cannot set property '${key}'.");
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
     * @return string
     */
    protected function getObjectName()
    {
        return get_class($this->model);
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
     * @param array $data
     */
    public function update(array $data, $id)
    {
        $key = md5($this->getObjectName() . '.all');
        $keystate = md5($this->getObjectName() . '.State');
        $this->cache->remove($key);
        $this->cache->remove($keystate);
        return $this->model->where('id', '=', $id)->update($data);
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