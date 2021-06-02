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
 * @version 2.0.0
 *
 */

namespace alonity\router;

class ResponseInheritance implements ResponseInterface {

	private $code = 200;

	private $headers = [];

	public function send($data = '') {

		http_response_code($this->code);

		echo $data;
	}

	public function setCode(int $code) : ResponseInterface {
		$this->code = $code;

		return $this;
	}

	public function setHeaders(array $headers) : ResponseInterface {
		$this->headers = array_replace_recursive($this->headers, $headers);

		return $this;
	}

	public function setHeader(string $key, $value) : ResponseInterface {

		$this->headers[$key] = $value;

		return $this;
	}
}

?>
