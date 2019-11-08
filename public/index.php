<?php

declare(strict_types=1);

use Zend\HttpHandlerRunner\Emitter\SapiEmitter;
use League\Route\Router;
use Middlewares\Whoops;

require_once dirname(__DIR__).'/vendor/autoload.php';

// Load evironment variables
$dotenv = Dotenv\Dotenv::create(__DIR__.'/../');
$dotenv->load();

// Get container service providers
$container = include __DIR__.'/../src/container.php';

// Set request globals
$request = Zend\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER,
    $_GET,
    $_POST
);

// Instantiate router
$router = new Router;

// Register error handler middleware
$whoops = (new \Whoops\Run())
                ->prependHandler(new \Whoops\Handler\PrettyPageHandler())
                ->register();
$router->middleware(new Whoops($whoops));

// Instantiate eloquent capsule
$database = $container->get('database');

// Invoke all routes via instance
include dirname(__DIR__).'/src/routes.php';

// Dispatch router request
$response = $router->dispatch($request);

// Emit response to browser
(new SapiEmitter)->emit($response);
