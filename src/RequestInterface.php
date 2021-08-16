<?php

/**
 * Request interface
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
 * @version 2.0.1
 *
 */

namespace alonity\router;

interface RequestInterface {



	/**
	 * Get array of headers like key => value (keys in lower case)
	 *
	 * @example array('connection' => 'close', 'cache-control' => 'no-cache')
	 *
	 * @return array
	*/
	public function getHeaders() : array;



	/**
	 * Get uri string
	 *
	 * @return string|null
	 */
	public function getURI() : ?string;



    /**
     * Get request body
     *
     * @return array
     */
    public function getBody() : array;



	/**
	 * Set request parameters
	 *
	 * @param $params array
	 *
	 * @return self
	 */
	public function setParams(array $params) : self;



	/**
	 * Get request parameters
	 *
	 * @return array
	*/
	public function getParams() : array;



	/**
	 * Set signle parameter manually
	 *
	 * @param $key string
	 *
	 * @param $value mixed
	 *
	 * @return self
	*/
	public function setParam(string $key, $value) : self;



	/**
	 * Get any parameter by key
	 *
	 * @param $key string
	 *
	 * @return mixed|null
	*/
	public function getParam(string $key);



    /**
     * Get request method
     *
     * @return string
     */
    public function getMethod() : string;



    /**
     * Get request IP
     *
     * @return string
     */
    public function getIP() : string;


}