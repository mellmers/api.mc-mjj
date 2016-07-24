<?php

namespace projectx\api\gameAccount;

use Silex\Application;
use Silex\ServiceProviderInterface;

class GameAccountServiceProvider implements ServiceProviderInterface
{
    /** {@inheritdoc} */
    public function register(Application $app)
    {
        $app['repo.gameAccount'] = $app->share(function (Application $app) {
            return new GameAccountRepository($app, $app['db']);
        });

        $app['service.gameAccount'] = $app->share(function (Application $app) {
            return new GameAccountService($app['repo.gameAccount']);
        });

        $app->mount('/gameAccount', new GameAccountRoutesProvider());
    }

    /** {@inheritdoc} */
    public function boot(Application $app)
    {
        /** @var GameAccountRepository $repo */
        $repo = $app['repo.gameAccount'];
    }
}