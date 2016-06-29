<?php

namespace projectx\api\game;

use Silex\Application;
use Silex\ServiceProviderInterface;

class GameServiceProvider implements ServiceProviderInterface
{
    /** {@inheritdoc} */
    public function register(Application $app)
    {
        $app['repo.game'] = $app->share(function (Application $app) {
            return new GameRepository($app['db']);
        });

        $app['service.game'] = $app->share(function (Application $app) {
            return new GameService($app['repo.game']);
        });

        $app->mount('/game', new GameRoutesProvider());
    }

    /** {@inheritdoc} */
    public function boot(Application $app)
    {
        /** @var GameRepository $repo */
        $repo = $app['repo.game'];
    }
}