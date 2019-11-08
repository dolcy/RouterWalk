<?php

declare(strict_types=1);

namespace RouterApp\ServiceProvider;

use Illuminate\Database\Capsule\Manager;
use League\Container\ServiceProvider\AbstractServiceProvider;

class DatabaseServiceProvider extends AbstractServiceProvider
{
    /**
     * Create settings array for service.
     *
     * @var array
     */
    protected $provides = ['database'];

    public function register()
    {
        $this->getContainer()->add('database', function () {
            // Set eloquent manager
            $capsule = new Manager();
            $capsule->addConnection([
              'driver' => getenv('DB_CONNECTION'),
              'host' => getenv('DB_HOST'),
              'database' => getenv('DB_DATABASE'),
              'username' => getenv('DB_USERNAME'),
              'password' => getenv('DB_PASSWORD'),
              'port' => getenv('DB_PORT'),
              'charset' => 'utf8',
              'collation' => 'utf8_unicode_ci',
              'prefix' => '',
            ]);

            $capsule->setAsGlobal();
            $capsule->bootEloquent();

            return $capsule;
        });
    }
}
