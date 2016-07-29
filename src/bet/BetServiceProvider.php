<?php

namespace projectx\api\bet;

use Silex\Application;
use Silex\ServiceProviderInterface;

class BetServiceProvider implements ServiceProviderInterface
{
    /** {@inheritdoc} */
    public function register(Application $app)
    {
        $app['repo.bet'] = $app->share(function (Application $app) {
            return new BetRepository($app, $app['db']);
        });

        $app['service.bet'] = $app->share(function (Application $app) {
            return new BetService($app['repo.bet']);
        });

        $app->mount('/bet', new BetRoutesProvider());
    }

    /** {@inheritdoc} */
    public function boot(Application $app)
    {
        /** @var BetRepository $repo */
        $repo = $app['repo.bet'];
    }
}