<?php

/**
 * Main class
 *
 *
 * @author Qexy admin@qexy.org
 *
 * @copyright © 2021 Alonity
 *
 * @package alonity\router
 *
 * @license MIT
 *
 * @version 2.0.0
 *
 */

namespace alonity\router;

class Router {
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

	private function method(string $method, string $uri, $callback = null, $middleware = true, array $handlers = []) : self {
		$method = strtoupper($method);

		$this->routes[$method][] = new Route($method, $uri, $callback, $middleware, $handlers);

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
	 *
	 * @return self
	 */
	public function get(string $uri, $callback = null, $middleware = true, array $handlers = []) : self {
		return $this->method(__FUNCTION__, $uri, $callback, $middleware, $handlers);
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
	 *
	 * @return self
	 */
	public function post(string $uri, $callback = null, $middleware = true, array $handlers = []) : self {
		return $this->method(__FUNCTION__, $uri, $callback, $middleware, $handlers);
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
	 *
	 * @return self
	 */
	public function put(string $uri, $callback = null, $middleware = true, array $handlers = []) : self {
		return $this->method(__FUNCTION__, $uri, $callback, $middleware, $handlers);
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
	 *
	 * @return self
	 */
	public function head(string $uri, $callback = null, $middleware = true, array $handlers = []) : self {
		return $this->method(__FUNCTION__, $uri, $callback, $middleware, $handlers);
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
	 *
	 * @return self
	 */
	public function patch(string $uri, $callback = null, $middleware = true, array $handlers = []) : self {
		return $this->method(__FUNCTION__, $uri, $callback, $middleware, $handlers);
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
	 *
	 * @return self
	 */
	public function delete(string $uri, $callback = null, $middleware = true, array $handlers = []) : self {
		return $this->method(__FUNCTION__, $uri, $callback, $middleware, $handlers);
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
	 *
	 * @return self
	 */
	public function connect(string $uri, $callback = null, $middleware = true, array $handlers = []) : self {
		return $this->method(__FUNCTION__, $uri, $callback, $middleware, $handlers);
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
	 *
	 * @return self
	 */
	public function trace(string $uri, $callback = null, $middleware = true, array $handlers = []) : self {
		return $this->method(__FUNCTION__, $uri, $callback, $middleware, $handlers);
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
	 *
	 * @return self
	 */
	public function options(string $uri, $callback = null, $middleware = true, array $handlers = []) : self {
		return $this->method(__FUNCTION__, $uri, $callback, $middleware, $handlers);
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
	 *
	 * @return self
	 */
	public function any(string $uri, $callback = null, $middleware = true, array $handlers = []) : self {
		return $this->method(__FUNCTION__, $uri, $callback, $middleware, $handlers);
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



	/**
	 * Main executor method
	*/
	public function execute(){
		$method = $this->request->getMethod();

		$uri = $this->request->getURI();

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
			$pattern = addcslashes($route->getURI(), '.\\+?[]^$(){}=!<>|-#/');

			preg_match_all('/\:([a-z0-9_]+)/i', $route->getURI(), $matches);

			$pattern = str_replace('*', '(.*)?', $pattern);

			if(!empty($matches) && isset($matches[1]) && !empty($matches[1])){

				$handlers = $route->getHandlers();

				if(!empty($handlers)){
					$pattern = strtr($pattern, $handlers);
				}

				$pattern = str_replace($matches[0], '([a-zA-Z0-9\-_]+)', $pattern);
			}

			if(preg_match("/^{$pattern}\/?$/i", $uri, $params)){

				$middle = $route->getMiddleware();

				$this->request->setParams($this->combineParams(@$matches[1], $params));

				if(is_callable($middle)){
					$middle = $middle($this->request, $this->response);
				}

				if($middle){
					$find = true;
					$this->activated = $route; break;
				}
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

		return $route->execute($this->request, $this->response);
	}
}

?>