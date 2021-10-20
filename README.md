# Alonity Router
Fast default router of Alonity framework

## Install

`composer require alonity/router`

### Example
```php
use alonity\router\Router;

$router = new Router();

$router->get('page/:name', function($req, $res){ $res->send('Page: '.$req->params['name']); })
    ->get('parent', null, true, [], [
        ['child', function($req, $res){ echo 'child'; }]
    ])
    ->post('send/via/post')
    ->setUndefinedRoute(new Route('', '', 'Custom 404 page'));

$router->execute();
```