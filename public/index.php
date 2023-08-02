<?php

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;

$routes = include __DIR__.'/../routes/web.php';
$container = include __DIR__.'/../config/app.php';

$request = Request::createFromGlobals();


$container->setParameter('charset', 'UTF-8');

$response = $container->get('framework')->handle($request);
$response->send();


?>