<?php

declare(strict_types=1);

namespace RouterApp\ServiceProvider;

use Rareloop\Router\Router;
use League\Container\ServiceProvider\AbstractServiceProvider;

class RouteServiceProvider extends AbstractServiceProvider
{
    /**
     * Create settings array for service.
     *
     * @var array
     */
    protected $provides = ['router'];

    public function register()
    {
        $this->getContainer()->add('router', function () {
            // Set router
            $router = new Router();

            return $router;
        });
    }
}
