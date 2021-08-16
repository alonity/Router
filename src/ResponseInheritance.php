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
 * @version 2.0.3
 *
 */

namespace alonity\router;

class ResponseInheritance implements ResponseInterface {

	private $code = 200;

	private $headers = [];

	public function send($data = '', int $type = 0) : ResponseInterface {

		http_response_code($this->code);

		switch ($type){
            case Router::RESPONSE_JSON:
                $this->setHeader('Content-Type: application/json');
                $data = json_encode($data);
            break;

            case Router::RESPONSE_XML:
                $this->setHeader('Content-type: text/xml');
            break;
        }

		if(!empty($this->headers)){
		    foreach($this->headers as $header){
		        header($header);
            }
        }

		echo $data;

		return $this;
	}

	public function end(){
	    exit;
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