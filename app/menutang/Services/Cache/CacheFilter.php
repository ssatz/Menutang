<?php
/*
 * This file(CacheFilter.php) is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Services\Cache;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CacheFilter {
    /**
     * @var ICacheService
     */
    protected $cache;
    /**
     * @var Str
     */
    protected $str;
    /**
     * @var Request
     */
    protected $request;

    /**
     * @param ICacheService $cacheService
     * @param Str $str
     * @param Request $request
     */
    public function __construct(ICacheService $cacheService,Str $str,Request $request){
        $this->str=$str;
        $this->request=$request;
        $this->cache = $cacheService;
        $this->cache->tag('routes');
    }

    /**
     * @param $route
     * @param $request
     * @param null $response
     * @return mixed
     */
    public function filter($route, $request, $response = null) {
        $cacheContentKey = 'request-' . $this->str->slug($this->request->url());
        if (is_null($response) && $this->cache->has($cacheContentKey)) {
            return $this->cache->get($cacheContentKey);
        } elseif (!is_null($response) && !$this->cache->has($cacheContentKey)) {
                $this->cache->put($cacheContentKey, $response->getContent(), 60);
        }
    }
}