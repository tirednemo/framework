<?php

use Simplex\Framework;
use Simplex\StringResponseListener;
use Symfony\Component\DependencyInjection;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\EventDispatcher;
use Symfony\Component\HttpFoundation;
use Symfony\Component\HttpKernel;
use Symfony\Component\Routing;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run as WhoopsRun;


$container = new DependencyInjection\ContainerBuilder();



$container->register('context', Routing\RequestContext::class);
$container->register('matcher', Routing\Matcher\UrlMatcher::class)
    ->setArguments([$routes, new Reference('context')])
;
// $container->register('matcher', Routing\Matcher\UrlMatcher::class)
//     ->setArguments(['%routes%', new Reference('context')])
// ;
$container->register('request_stack', HttpFoundation\RequestStack::class);
$container->register('controller_resolver', HttpKernel\Controller\ControllerResolver::class);
$container->register('argument_resolver', HttpKernel\Controller\ArgumentResolver::class);



$container->register('listener.router', HttpKernel\EventListener\RouterListener::class)
    ->setArguments([new Reference('matcher'), new Reference('request_stack')])
;
$container->register('listener.response', HttpKernel\EventListener\ResponseListener::class)
    ->setArguments(['%charset%'])
;
$container->register('listener.exception', HttpKernel\EventListener\ErrorListener::class)
    ->setArguments(['App\Http\Controllers\ErrorController::exception'])
;
// $container->register('listener.exception', HttpKernel\EventListener\ErrorListener::class)
//     ->setArguments([new Reference('whoops_handler')])
// ;
$container->register('dispatcher', EventDispatcher\EventDispatcher::class)
    ->addMethodCall('addSubscriber', [new Reference('listener.router')])
    ->addMethodCall('addSubscriber', [new Reference('listener.response')])
    ->addMethodCall('addSubscriber', [new Reference('listener.exception')])
;


$container->register('listener.string_response', StringResponseListener::class);
$container->getDefinition('dispatcher')
    ->addMethodCall('addSubscriber', [new Reference('listener.string_response')])
;

// $container->register('whoops_handler', PrettyPageHandler::class);
// $container->register('whoops', WhoopsRun::class)
//     ->addMethodCall('pushHandler', [new Reference('whoops_handler')])
// ;
// $whoopsHandler = new PrettyPageHandler();
// $whoops = new WhoopsRun();
// $whoops->pushHandler($whoopsHandler);
// $whoops->register();


$container->register('framework', Framework::class)
    ->setArguments([
        new Reference('dispatcher'),
        new Reference('controller_resolver'),
        new Reference('request_stack'),
        new Reference('argument_resolver'),
    ])
;

return $container;
?>