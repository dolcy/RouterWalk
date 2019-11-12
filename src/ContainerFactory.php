<?php

declare(strict_types=1);

namespace RouterApp;

use League\Container\Container;
use League\Container\ReflectionContainer;
use RouterApp\ServiceProvider\DatabaseServiceProvider;

class ContainerFactory
{
    public static function start()
    {
        // Register the reflection container for autowiring
        $container = new Container();

        // Add Services
        $container->addServiceProvider(DatabaseServiceProvider::class);

        return $container;
    }
}
