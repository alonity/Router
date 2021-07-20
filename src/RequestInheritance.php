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

class RequestInheritance implements RequestInterface {

	private $headers;

	private $params = [];

	public function getHeaders() : array {
		if(!is_null($this->headers)){
			return $this->headers;
		}

		if(!function_exists('getallheaders')){
			function getallheaders() : array {
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
		return $this->params[$key] ?? null;
	}

    public function getMethod() : string {
        return @$_SERVER['REQUEST_METHOD'];
    }

    public function getIP() : string {
        if(!empty($_SERVER['HTTP_CF_CONNECTING_IP'])){
            $ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
        }elseif(!empty($_SERVER['HTTP_X_REAL_IP'])){
            $ip = $_SERVER['HTTP_X_REAL_IP'];
        }elseif(!empty($_SERVER['HTTP_CLIENT_IP'])){
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        preg_match("/\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}/i", $ip, $matches);

        return (isset($matches[0])) ? $matches[0] : $ip;
    }
}