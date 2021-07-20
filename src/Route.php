<?php

/**
 * Route class
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
 * @version 2.0.2
 *
 */

namespace alonity\router;

class Route {
	private $method = 'GET';

	private $uri = '';

	private $callback;

	private $middleware = true;

	private $handlers = [];

	public function __construct(string $method = 'GET', string $uri = '', $callback = null, $middleware = true, array $handlers = []){
		$this->method = $method;

		$this->uri = $uri;

		$this->callback = $callback;

		$this->middleware = $middleware;

		$this->handlers = $this->array_key_prefix($handlers, ':');
	}

	private function array_key_prefix(array $array, string $prefix) : array {
		$newarr = [];

		foreach($array as $k => $v){
			$newarr[$prefix.$k] = "({$v})";
		}

		return $newarr;
	}

	public function execute(RequestInterface $request, ResponseInterface $response){
		$callback = $this->callback;

        if(is_array($callback)){
            if(!isset($callback[0]) || !isset($callback[1])){
                throw new RouteException("Router callback array is not valid");
            }elseif(!class_exists($callback[0])){
                throw new RouteException("Class \"{$callback[0]}\" not found");
            }

            $instance = new $callback[0];

            echo $instance->{$callback[1]}($request, $response);
        }elseif(is_callable($callback)){
            $callback($request, $response);
        }elseif(is_string($callback) || is_int($callback) || is_float($callback)){
			echo $callback;
		}

		return '';
	}

	public function getURI() : string {
		return $this->uri;
	}

	public function getMethod() : string {
		return $this->method;
	}

	public function getCallback() {
		return $this->callback;
	}

	public function getMiddleware(){
		return $this->middleware;
	}

	public function getHandlers(){
		return $this->handlers;
	}
}