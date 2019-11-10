<?php

declare(strict_types=1);

namespace RouterApp;

use League\Container\Container;
use RouterApp\ServiceProvider\DatabaseServiceProvider;
use RouterApp\ServiceProvider\RouteServiceProvider;

class ContainerFactory
{
    public static function start()
    {
        $container = new Container();
        // Add Services
        $container->addServiceProvider(DatabaseServiceProvider::class);
        $container->addServiceProvider(RouteServiceProvider::class);

        return $container;
    }
}
