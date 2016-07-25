<?php

namespace projectx\api\user;

use Silex\Application;
use Silex\ServiceProviderInterface;

class UserServiceProvider implements ServiceProviderInterface
{
    /** {@inheritdoc} */
    public function register(Application $app)
    {
        $app['repo.user'] = $app->share(function (Application $app) {
            return new UserRepository($app, $app['db']);
        });

        $app['service.user'] = $app->share(function (Application $app) {
            return new UserService($app['repo.user']);
        });

        $app->mount('/user', new UserRoutesProvider());
    }

    /** {@inheritdoc} */
    public function boot(Application $app)
    {
        /** @var UserRepository $repo */
        $repo = $app['repo.user'];
    }
}