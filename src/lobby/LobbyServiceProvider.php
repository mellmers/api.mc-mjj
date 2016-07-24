<?php

namespace projectx\api\lobby;

use Silex\Application;
use Silex\ServiceProviderInterface;

class LobbyServiceProvider implements ServiceProviderInterface
{
    /** {@inheritdoc} */
    public function register(Application $app)
    {
        $app['repo.lobby'] = $app->share(function (Application $app) {
            return new LobbyRepository($app, $app['db']);
        });

        $app['service.lobby'] = $app->share(function (Application $app) {
            return new LobbyService($app['repo.lobby']);
        });

        $app->mount('/lobby', new LobbyRoutesProvider());
    }

    /** {@inheritdoc} */
    public function boot(Application $app)
    {
        /** @var LobbyRepository $repo */
        $repo = $app['repo.lobby'];
    }
}