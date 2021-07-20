<?php

/**
 * Response class
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

class ResponseInheritance implements ResponseInterface {

	private $code = 200;

	private $headers = [];

	public function send($data = '') {

		http_response_code($this->code);

		if(!empty($this->headers)){
		    foreach($this->headers as $header){
		        header($header);
            }
        }

		echo $data;
	}

	public function setCode(int $code) : ResponseInterface {
		$this->code = $code;

		return $this;
	}

	public function setHeaders(array $headers) : ResponseInterface {
		$this->headers = array_merge($this->headers, $headers);

        $this->headers = array_unique($this->headers);

		return $this;
	}

	public function setHeader(string $value) : ResponseInterface {

	    if(in_array($value, $this->headers)){
	        return $this;
        }

		$this->headers[] = $value;

		return $this;
	}
}