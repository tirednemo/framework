<?php

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;

$pathsToTemplates = [__DIR__ . '/../resources/views/templates'];
$pathToCompiledTemplates = __DIR__ . '/../resources/views/compiled';

$routes = include __DIR__.'/../routes/web.php';
$container = include __DIR__.'/../config/app.php';

$request = Request::createFromGlobals();


$container->setParameter('charset', 'UTF-8');


echo $viewFactory->make('page', [
    'title' => 'Title',
    'text' => 'This is my text!',
])->render();



$response = $container->get('framework')->handle($request);
$response->send();


?>