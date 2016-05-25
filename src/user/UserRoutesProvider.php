<?php

namespace projectx\api\user;

use Silex\Application;
use Silex\ControllerCollection;
use Silex\ControllerProviderInterface;

/**
 * Class UserRoutesProvider
 * @package projectx\api\user
 */
class UserRoutesProvider implements ControllerProviderInterface
{

    /** {@inheritdoc} */
    public function connect(Application $app)
    {
        /** @var ControllerCollection $controllers */
        $controllers = $app['controllers_factory'];

        /**
         * @SWG\Parameter(name="id", type="integer", format="int32", in="path")
         * @SWG\Tag(name="user", description="All about users")
         */

        /**
         * @SWG\Get(
         *     path="/user/",
         *     tags={"user"},
         *     @SWG\Response(response="200", description="An example resource")
         * )
         */
        // see https://github.com/silexphp/Silex/issues/149
        $controllers->get('/', 'service.user:getList');

        /**
         * @SWG\Post(
         *     tags={"user"},
         *     path="/user/",
         *     @SWG\Parameter(name="user", in="body", @SWG\Schema(ref="#/definitions/user")),
         *     @SWG\Response(response="201", description="An example resource")
         * )
         */
        $controllers->post('/', 'service.user:create');

        return $controllers;
    }
}