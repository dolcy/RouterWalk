<?php

declare(strict_types=1);

namespace RouterApp\ServiceProvider;

use League\Container\ServiceProvider\AbstractServiceProvider;
use League\Route\Router;

class RouteServiceProvider extends AbstractServiceProvider
{
    /**
     * Create settings array for service.
     *
     * @var array
     */
    protected $provides = ['router'];

    /**
     * Register router service.
     *
     * @return mixed
     */
    public function register()
    {
        $this->getContainer()->add('router', function () {

            // Instantiate router
            $router = new Router();

            // Include routes
            include \dirname(__DIR__).'/Route/Routes.php';

            return $router;
        });
    }
}
