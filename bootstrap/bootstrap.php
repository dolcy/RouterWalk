<?php

declare(strict_types=1);

require_once dirname(__DIR__).'/vendor/autoload.php';

use RouterApp\ContainerFactory;
use Zend\HttpHandlerRunner\Emitter\SapiEmitter;
use Zend\Diactoros\ServerRequestFactory;
use League\Route\Router;
use Middlewares\Whoops;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;

// Load evironment variables
$dotenv = \Dotenv\Dotenv::create(__DIR__.'/../');
$dotenv->load();

// New monolog instance and handlers
$logger = new Logger('routerApp');
$logger->pushHandler(new StreamHandler('../logs/routerapp.log', Logger::DEBUG));
$logger->pushHandler(new FirePHPHandler());

// Register error handler
$whoops = (new \Whoops\Run())
                ->prependHandler(new \Whoops\Handler\PrettyPageHandler())
                ->register();

// Boot the container instance
try {
    $container = ContainerFactory::start();
} catch (Exception $e) {
    die($e->getMessage());
}

// Set request globals
$request = ServerRequestFactory::fromGlobals(
    $_SERVER,
    $_GET,
    $_POST
);

// Instantiate eloquent capsule
$database = $container->get('database');

// Instantiate eloquent capsule
$router = $container->get('router');

// // Register error handler middleware
$router->middleware(new Whoops($whoops));

// // Dispatch router request
$response = $router->dispatch($request);

// Emit response to browser
(new SapiEmitter)->emit($response);
