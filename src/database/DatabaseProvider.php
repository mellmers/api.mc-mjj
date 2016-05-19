<?php

namespace projectx\api\database;

use Silex\Application;
use Silex\Provider\DoctrineServiceProvider;
use Silex\ServiceProviderInterface;

class DatabaseProvider implements ServiceProviderInterface
{
    /** {@inheritdoc} */
    public function register(Application $app)
    {
        $app['db_user']     = 'project-x';
        $app['db_password'] = 'project-x';
        $app['db_name'] = 'project-x';

        $app->register(
            new DoctrineServiceProvider(),
            [
                'db.options' => [
                    'driver'   => 'pdo_mysql',
                    'host'     => 'localhost',
                    'dbname'   => $app['db_name'],
                    'user'     => $app['db_user'],
                    'password' => $app['db_password'],
                ],
            ]
        );
    }

    /** {@inheritdoc} */
    public function boot(Application $app)
    {
    }
}