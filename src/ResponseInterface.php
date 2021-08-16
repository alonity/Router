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
 * @version 2.0.2
 *
 */

namespace alonity\router;

interface ResponseInterface {


	/**
	 * Send response to client
	 *
	 * @param $data mixed
     *
     * @return self
	*/
	public function send($data, int $type = 0) : self;



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
	 * @param $value mixed
	 *
	 * @return self
	 */
	public function setHeader(string $value) : self;



	/**
	 * Set response code. Default 200
	 *
	 * @param $code int
	 *
	 * @return self
	 */
	public function setCode(int $code) : self;
}