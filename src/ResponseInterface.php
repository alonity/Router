<?php

/**
 * Response interface
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

interface ResponseInterface {


	/**
	 * Send response to client
	 *
	 * @param $data mixed
	*/
	public function send($data);



	/**
	 * Set headers multiple by key => value (keys in lower case)
	 *
	 * @param $headers array
	 *
	 * @return self
	 */
	public function setHeaders(array $headers) : self;



	/**
	 * Set single header manually
	 *
	 * @param $key string
	 *
	 * @param $value mixed
	 *
	 * @return self
	 */
	public function setHeader(string $key, $value) : self;



	/**
	 * Set response code. Default 200
	 *
	 * @param $code int
	 *
	 * @return self
	 */
	public function setCode(int $code) : self;
}