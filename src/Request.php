<?php

/**
 * Request class
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

class Request implements RequestInterface {

	private $headers;

	private $params = [];

	public function getHeaders() : array {
		if(!is_null($this->headers)){
			return $this->headers;
		}

		if(!function_exists('getallheaders')){
			function getallheaders(){
				$headers = [];

				foreach($_SERVER as $name => $value){
					if(substr($name, 0, 5) == 'HTTP_'){
						$headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
					}
				}

				return $headers;
			}
		}

		$this->headers = getallheaders();

		return $this->headers;
	}

	public function getURI() : ?string {
		return @preg_replace('/^(\/+)?(\?+)?/', '', $_SERVER['REQUEST_URI']);
	}

	public function setParams(array $params) : RequestInterface {
		$this->params = array_replace_recursive($this->params, $params);

		return $this;
	}

	public function getParams() : array {
		return $this->params;
	}

	public function setParam(string $key, $value) : RequestInterface {
		$this->params[$key] = $value;

		return $this;
	}

	public function getParam(string $key) {
		return isset($this->params[$key]) ? $this->params[$key] : null;
	}

	public function getMethod() : string {
		return @$_SERVER['REQUEST_METHOD'];
	}
}

?>