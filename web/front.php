<?php

// example.com/web/front.php
require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;

$routes = include __DIR__.'/../src/app.php';
$container = include __DIR__.'/../src/container.php';

$request = Request::createFromGlobals();

$container->setParameter('charset', 'UTF-8');
// $container->setParameter('routes', $routes);

$response = $container->get('framework')->handle($request);

$response->send();

?>