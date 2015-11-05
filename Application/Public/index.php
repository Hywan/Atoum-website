<?php

require_once
    dirname(__DIR__) . DIRECTORY_SEPARATOR .
    'Bootstrap.php';

use Hoa\Core;
use Hoa\Dispatcher;
use Hoa\Router;

Core::enableErrorHandler();
Core::enableExceptionHandler();

$dispatcher = new Dispatcher\ClassMethod([
    'synchronous.call'  => 'Application\Resource\(:call:U:)',
    'synchronous.able'  => '(:%variables._method:U:)',
    'asynchronous.call' => '(:%synchronous.call:)',
    'asynchronous.able' => '(:%synchronous.able:)'
]);
$router = new Router\Http();

$router
    // Private rules.
    ->_get(
        '_resource',
        '/Static/(?<resource>)'
    )
    ->_get(
        'github',
        'https://github.com/atoum/(?<repository>)?'
    )

    // Public rules.
    ->get(
        'fallback',
        '/.*',
        'Fallback'
    )
    /*
    ->get(
        'features',
        '/features\.html',
        'index',
        'features'
    )
    ->get(
        'source',
        '/source\.html',
        'index',
        'source'
    )
    ->get(
        'documentation',
        '/documentation\.html',
        'documentation',
        'index'
    )
    ->get(
        'community',
        '/community\.html',
        'index',
        'community'
    )
    ->get(
        'about',
        '/about\.html',
        'index',
        'about'
    )
    ->get(
        'root',
        '/',
        'index',
        'index'
    )*/
    ;

$dispatcher->dispatch($router);
