<?php

require_once '/usr/local/lib/Hoa/Core/Core.php';

\Hoa\Core::enableErrorHandler();
\Hoa\Core::enableExceptionHandler();

$dispatcher = new \Hoa\Dispatcher\Basic(array(
    'asynchronous.action' => '(:%synchronous.action:)'
));
$router = new \Hoa\Router\Http();

$router
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
    )
    ->_get('_resource', '/Static/(?<resource>)');

try {

    $dispatcher->dispatch($router);
}
catch ( \Hoa\Core\Exception $e ) {

    var_dump($e->raise(true));
    exit;

    $router->route('/error.html');
    $rule                                                = &$router->getTheRule();
    $rule[\Hoa\Router\Http::RULE_VARIABLES]['exception'] = $e;
    $dispatcher->dispatch($router);
}
