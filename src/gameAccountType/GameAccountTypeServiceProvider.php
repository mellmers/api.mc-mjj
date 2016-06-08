<?php

namespace projectx\api\gameAccountType;

use Silex\Application;
use Silex\ServiceProviderInterface;

class GameAccountTypeServiceProvider implements ServiceProviderInterface
{
    /** {@inheritdoc} */
    public function register(Application $app)
    {
        $app['repo.gameAccountType'] = $app->share(function (Application $app) {
            return new GameAccountTypeRepository($app['db']);
        });

        $app['service.gameAccountType'] = $app->share(function (Application $app) {
            return new GameAccountTypeService($app['repo.gameAccountType']);
        });

        $app->mount('/gameAccountType', new GameAccountTypeRoutesProvider());
    }

    /** {@inheritdoc} */
    public function boot(Application $app)
    {
        /** @var GameAccountTypeRepository $repo */
        $repo = $app['repo.gameAccountType'];
    }
}