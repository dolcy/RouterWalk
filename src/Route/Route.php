<?php

declare(strict_types=1);

namespace RouterApp\Route;

use League\Route\Router;
use League\Route\RouteGroup;
use League\Route\Strategy\JsonStrategy;
use Zend\Diactoros\ResponseFactory;

final class Route
{
    public static function resource()
    {
        $responseFactory = new ResponseFactory;
        $strategy = new JsonStrategy($responseFactory);
        // Instantiate router
        $router = (new Router())->setStrategy($strategy);
        // Route patients group
        $router->group('/patients', function (RouteGroup $route) {
            $route->map('GET', '/', 'RouterApp\Controller\PatientsController::patientIndex');
            $route->map('GET', '/{id}', 'RouterApp\Controller\PatientsController::patientFindById');
            $route->map('POST', '/', 'RouterApp\Controller\PatientsController::patientCreate');
            $route->map('PATCH', '/{id}', 'RouterApp\Controller\PatientsController::patientUpdateById');
            $route->map('DELETE', '/{id}', 'RouterApp\Controller\PatientsController::patientDeleteById');
        });
        // Route patients metrics group
        $router->group('/patients/{id}/metrics', function (RouteGroup $route) {
            $route->map('GET', '/', 'RouterApp\Controller\PatientsMetricsController::patientMetricIndex');
            $route->map('GET', '/{any:alphanum_dash}', 'RouterApp\Controller\PatientsMetricsController::patientMetricFindById');
            $route->map('POST', '/', 'RouterApp\Controller\PatientsMetricsController::patientMetricCreate');
            $route->map('PATCH', '/{any:alphanum_dash}', 'RouterApp\Controller\PatientsMetricsController::patientMetricUpdateById');
            $route->map('DELETE', '/{any:alphanum_dash}', 'RouterApp\Controller\PatientsMetricsController::patientMetricDeleteById');
        });

        return $router;
    }
}
