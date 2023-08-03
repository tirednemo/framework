<?php


$filesystem = new \Illuminate\Filesystem\Filesystem;
$eventDispatcher = new \Illuminate\Events\Dispatcher();

$viewResolver = new \Illuminate\View\Engines\EngineResolver;
$bladeCompiler = new \Illuminate\View\Compilers\BladeCompiler($filesystem, $pathToCompiledTemplates);

$viewResolver->register('blade', function () use ($bladeCompiler) {
    return new \Illuminate\View\Engines\CompilerEngine($bladeCompiler);
});

$viewFinder = new \Illuminate\View\FileViewFinder($filesystem, $pathsToTemplates);
$viewFactory = new \Illuminate\View\Factory($viewResolver, $viewFinder, $eventDispatcher);
