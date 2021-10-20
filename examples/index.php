<?php

use alonity\router\RequestInterface;
use alonity\router\ResponseInterface;
use alonity\router\Route;
use alonity\router\Router;

ini_set('display_errors', true);
error_reporting(E_ALL);

require_once('../src/ResponseInterface.php');
require_once('../src/RequestInterface.php');
require_once('../src/RequestInheritance.php');
require_once('../src/ResponseInheritance.php');
require_once('../src/Route.php');
require_once('../src/Router.php');

//require_once('../../../autoload.php');

$router = new Router();

$router->get('', function(RequestInterface $request, ResponseInterface $response){ $response->send('Home page via '.$request->getMethod().' method'); })

	->post('send/request/via/post', function(RequestInterface $request, ResponseInterface $response){ $response->send('This request has been sent via '.$request->getMethod().' method'); })

	->get('send/request/via/get', function(RequestInterface $request, ResponseInterface $response){ $response->send('This request has been sent via '.$request->getMethod().' method'); })

	->get('send/request/with/:param', function(RequestInterface $request, ResponseInterface $response){ $response->send('This request has been sent via '.$request->getMethod().' method with parameter "param": '.$request->getParam('param')); })

	->get('hello/:id/world/:id/*', function(RequestInterface $request, ResponseInterface $response){ $response->send('This request has been sent via '.$request->getMethod().' method with custom pattern param "id": '.$request->getParam('id').'([0-9]+ only)'); }, function(RequestInterface $request, ResponseInterface $response){
		// Middleware true|false
		return intval($request->getParam('id')) == 10;
	}, [
		'id' => '\d+'
	]);


// Set not found page
$router->setUndefinedRoute(new Route('', '', function(){ return 'Page not found'; }));

// Alternative
// $router->setUndefinedRoute(new Route('', '', 'Page not found'));

$router->execute();

?>