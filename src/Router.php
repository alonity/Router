<?php

/**
 * Main class
 *
 *
 * @author Qexy admin@qexy.org
 *
 * @copyright © 2022 Alonity
 *
 * @package alonity\router
 *
 * @license MIT
 *
 * @version 2.1.1
 *
 */

namespace alonity\router;

class Router {
    const RESPONSE_TEXT = 0;

    const RESPONSE_JSON = 1;

    const RESPONSE_XML = 2;

	private $request, $response, $activated;

	/** @var $undefined Route|null */
	private $undefined;

	private $routes = [
		'GET' => [],
		'POST' => [],
		'HEAD' => [],
		'PUT' => [],
		'DELETE' => [],
		'PATCH' => [],
		'CONNECT' => [],
		'OPTIONS' => [],
		'TRACE' => [],
		'ANY' => []
	];

	public function __construct(?RequestInterface $request = null, ?ResponseInterface $response = null){
		$this->request = is_null($request) ? new RequestInheritance() : $request;

		$this->response = is_null($response) ? new ResponseInheritance() : $response;

		$this->setUndefinedRoute(new Route('', '', function(RequestInterface $request, ResponseInterface $response){
			$response->setCode(404)->send("{$request->getMethod()} / 404");
		}));

		$this->activated = $this->undefined;
	}

	private function method(string $method, string $uri, $callback = null, $middleware = true, array $handlers = [], array $childs = []) : self {
		$method = strtoupper($method);

		$this->routes[$method][] = new Route($method, $uri, $callback, $middleware, $handlers, $childs);

		return $this;
	}



	/**
	 * GET method
	 *
	 * @param $uri string
	 *
	 * @param $callback mixed
	 *
	 * @param $middleware mixed
	 *
	 * @param $handlers array
     *
     * @param $childs array
	 *
	 *
	 * @return self
	 */
	public function get(string $uri, $callback = null, $middleware = true, array $handlers = [], array $childs = []) : self {
		return $this->method(__FUNCTION__, $uri, $callback, $middleware, $handlers, $childs);
	}



	/**
	 * POST method
	 *
	 * @param $uri string
	 *
	 * @param $callback mixed
	 *
	 * @param $middleware mixed
	 *
	 * @param $handlers array
     *
     * @param $childs array
	 *
	 *
	 * @return self
	 */
	public function post(string $uri, $callback = null, $middleware = true, array $handlers = [], array $childs = []) : self {
		return $this->method(__FUNCTION__, $uri, $callback, $middleware, $handlers, $childs);
	}



	/**
	 * PUT method
	 *
	 * @param $uri string
	 *
	 * @param $callback mixed
	 *
	 * @param $middleware mixed
	 *
	 * @param $handlers array
     *
     * @param $childs array
	 *
	 *
	 * @return self
	 */
	public function put(string $uri, $callback = null, $middleware = true, array $handlers = [], array $childs = []) : self {
		return $this->method(__FUNCTION__, $uri, $callback, $middleware, $handlers, $childs);
	}



	/**
	 * HEAD method
	 *
	 * @param $uri string
	 *
	 * @param $callback mixed
	 *
	 * @param $middleware mixed
	 *
	 * @param $handlers array
     *
     * @param $childs array
	 *
	 *
	 * @return self
	 */
	public function head(string $uri, $callback = null, $middleware = true, array $handlers = [], array $childs = []) : self {
		return $this->method(__FUNCTION__, $uri, $callback, $middleware, $handlers, $childs);
	}



	/**
	 * PATCH method
	 *
	 * @param $uri string
	 *
	 * @param $callback mixed
	 *
	 * @param $middleware mixed
	 *
	 * @param $handlers array
     *
     * @param $childs array
	 *
	 *
	 * @return self
	 */
	public function patch(string $uri, $callback = null, $middleware = true, array $handlers = [], array $childs = []) : self {
		return $this->method(__FUNCTION__, $uri, $callback, $middleware, $handlers, $childs);
	}



	/**
	 * DELETE method
	 *
	 * @param $uri string
	 *
	 * @param $callback mixed
	 *
	 * @param $middleware mixed
	 *
	 * @param $handlers array
     *
     * @param $childs array
	 *
	 *
	 * @return self
	 */
	public function delete(string $uri, $callback = null, $middleware = true, array $handlers = [], array $childs = []) : self {
		return $this->method(__FUNCTION__, $uri, $callback, $middleware, $handlers, $childs);
	}



	/**
	 * CONNECT method
	 *
	 * @param $uri string
	 *
	 * @param $callback mixed
	 *
	 * @param $middleware mixed
	 *
	 * @param $handlers array
     *
     * @param $childs array
	 *
	 *
	 * @return self
	 */
	public function connect(string $uri, $callback = null, $middleware = true, array $handlers = [], array $childs = []) : self {
		return $this->method(__FUNCTION__, $uri, $callback, $middleware, $handlers, $childs);
	}



	/**
	 * TRACE method
	 *
	 * @param $uri string
	 *
	 * @param $callback mixed
	 *
	 * @param $middleware mixed
	 *
	 * @param $handlers array
     *
     * @param $childs array
	 *
	 *
	 * @return self
	 */
	public function trace(string $uri, $callback = null, $middleware = true, array $handlers = [], array $childs = []) : self {
		return $this->method(__FUNCTION__, $uri, $callback, $middleware, $handlers, $childs);
	}



	/**
	 * OPTIONS method
	 *
	 * @param $uri string
	 *
	 * @param $callback mixed
	 *
	 * @param $middleware mixed
	 *
	 * @param $handlers array
     *
     * @param $childs array
	 *
	 *
	 * @return self
	 */
	public function options(string $uri, $callback = null, $middleware = true, array $handlers = [], array $childs = []) : self {
		return $this->method(__FUNCTION__, $uri, $callback, $middleware, $handlers, $childs);
	}



	/**
	 * Any method in request
	 *
	 * @param $uri string
	 *
	 * @param $callback mixed
	 *
	 * @param $middleware mixed
	 *
	 * @param $handlers array
     *
     * @param $childs array
	 *
	 *
	 * @return self
	 */
	public function any(string $uri, $callback = null, $middleware = true, array $handlers = [], array $childs = []) : self {
		return $this->method(__FUNCTION__, $uri, $callback, $middleware, $handlers, $childs);
	}



	/**
	 * Return all routes in method
	 *
	 * @param $method string|null
	 *
	 *
	 * @return Route[]
	*/
	public function getRoutes(?string $method = null) : array {
		$method = strtoupper($method);

		return $this->routes[$method] ?? [];
	}



	/**
	 * Set undefined route
	 *
	 * @param $route Route
	 *
	 * @return self
	*/
	public function setUndefinedRoute(Route $route) : self {
		$this->undefined = $route;

		return $this;
	}



	/**
	 * Return resulted route
	 *
	 * @return Route|null
	*/
	public function getActivatedRoute() : ?Route {
		return $this->activated;
	}



	/**
	 * Combine matches with parameters like key->value
	 *
	 * @param $matches array|null
	 *
	 * @param $params array|null
	 *
	 * @return array
	 *
	*/
	private function combineParams(?array $matches, ?array $params) : array {
		if(!is_array($matches) || empty($matches)){ return []; }

		if(!is_array($params) || empty($params)){ return []; }

		$res = [];

		foreach($matches as $k => $v){
			$pk = $k+1;

			if(isset($params[$pk])){
				$res[$v] = $params[$pk];
			}
		}

		return $res;
	}

    private function array_key_prefix(array $array, string $prefix) : array {
        $newarr = [];

        foreach($array as $k => $v){
            $newarr[$prefix.$k] = "({$v})";
        }

        return $newarr;
    }

	private function searchRoute(Route $route) : ?Route {

        $uri = $this->request->getURI();

        $pattern = addcslashes($route->getURI(), '.\\+?[]^$(){}=!<>|-#/');

        preg_match_all('/\:([a-z0-9_]+)/i', $route->getURI(), $matches);

        $pattern = str_replace('*', '(.*)?', $pattern);

        if(!empty($matches) && isset($matches[1]) && !empty($matches[1])){

            $handlers = $this->array_key_prefix($route->getHandlers(), ':');

            if(!empty($handlers)){
                $pattern = strtr($pattern, $handlers);
            }

            $pattern = str_replace($matches[0], '([a-zA-Z0-9\-_]+)', $pattern);
        }

        $isChilds = !empty($route->getChilds());

        if(preg_match("/^{$pattern}\/?$/i", $uri, $params)){

            $middle = $route->getMiddleware();

            $this->request->setParams($this->combineParams(@$matches[1], $params));

            if(is_callable($middle)){
                $middle = $middle($this->request, $this->response);
            }elseif(is_array($middle)){
                $middle = call_user_func_array($middle, [$this->request, $this->response]);
            }

            if($middle && !is_null($route->getCallback())){
                return $route;
            }
        }

        if($isChilds && preg_match("/^{$pattern}\/?/i", $uri, $params)){
            $search = $this->childs($route);

            if(!is_null($search)){
                return $search;
            }
        }

        return null;
    }


	private function childs(Route $parent) : ?Route {

        $find = null;

        foreach($parent->getChilds() as $child){
            // string $uri = '', $callback = null, $middleware = true, array $handlers = [], array $childs = []

            $method = $parent->getMethod();

            $uri = $parent->getURI();

            $callback = $parent->getCallback();

            $middleware = $parent->getMiddleware();

            $handlers = [];

            $childList = [];

            if(isset($child[0])){
                $method = $child[0];
            }

            if(isset($child[1])){
                $uri .= "/{$child[1]}";
            }

            if(isset($child[2])){
                $callback = $child[2];
            }

            if(isset($child[3])){
                $middleware = $child[3];
            }

            if(isset($child[4])){
                $handlers = $child[4];
            }

            if(isset($child[5])){
                $childList = $child[5];
            }

            $route = new Route(strtoupper($method), $uri, $callback, $middleware, $handlers, $childList);

            $find = $this->searchRoute($route);

            if(!is_null($find)){ break; }
        }

        return $find;
    }



	/**
	 * Main executor method
	*/
	public function execute(){
		$method = $this->request->getMethod();

		$routes = array_merge($this->getRoutes($method), $this->getRoutes('ANY'));

		$get = $_GET;

		array_shift($get);

		$this->request->setParams($get);

		if(empty($routes)){
			return $this->activated->execute($this->request, $this->response);
		}

		$find = false;

		$params = $matches = [];

		foreach($routes as $route){

            $search = $this->searchRoute($route);

            if(!is_null($search)){
                preg_match_all('/\:([a-z0-9_]+)/i', $search->getURI(), $matches);

                $find = true;

                $this->activated = $search; break;
            }
		}

		if(!empty($matches) && isset($matches[1]) && !empty($matches[1]) && !empty($params)){
			foreach($matches[1] as $k => $v){
				$pk = $k+1;

				if(isset($params[$pk])){
					$this->request->setParam($v, $params[$pk]);
				}
			}
		}

		$route = $find ? $this->activated : $this->undefined;

		foreach($route->getHandlers() as $k => $v){
		    if(is_null($this->request->getParam($k))){
                $this->request->setParam($k, $v);
            }
        }

		return $route->execute($this->request, $this->response);
	}
}