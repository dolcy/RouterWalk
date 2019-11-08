<?php

use League\Container\Container;

use RouterApp\ServiceProvider\DatabaseServiceProvider;
use RouterApp\ServiceProvider\RouteServiceProvider;

$container = new Container();

// Add Services
$container->addServiceProvider(DatabaseServiceProvider::class);
$container->addServiceProvider(RouteServiceProvider::class);

return $container;
