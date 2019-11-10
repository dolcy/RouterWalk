<?php

declare(strict_types=1);

namespace RouterApp\Route;

//TODO: Change to static routes

// PatientsController
$router->map('GET', '/patients', 'RouterApp\Controller\PatientsController::index');
$router->map('GET', '/patients/{id}', 'RouterApp\Controller\PatientsController::get');
$router->map('POST', '/patients', 'RouterApp\Controller\PatientsController::create');
$router->map('PATCH', '/patients/{id}', 'RouterApp\Controller\PatientsController::update');
$router->map('DELETE', '/patients/{id}', 'RouterApp\Controller\PatientsController::delete');

// PatientsMetricsController
$router->map('GET', '/patients/{id}/metrics', 'RouterApp\Controller\PatientsMetricsController::index');
$router->map('GET', '/patients/{id}/metrics/{any:alphanum_dash}', 'RouterApp\Controller\PatientsMetricsController::get');
$router->map('POST', '/patients/{id}/metrics', 'RouterApp\Controller\PatientsMetricsController::create');
$router->map('PATCH', '/patients/{id}/metrics/{any:alphanum_dash}', 'RouterApp\Controller\PatientsMetricsController::update');
$router->map('DELETE', '/patients/{id}/metrics/{any:alphanum_dash}', 'RouterApp\Controller\PatientsMetricsController::delete');
