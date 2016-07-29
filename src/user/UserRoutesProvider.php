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
         * @SWG\Get(
         *     path="/user/",
         *     tags={"user"},
         *     @SWG\Response(
         *         response="200",
         *         description="A List of all Users",
         *         @SWG\Schema(
         *          type="array",
         *          @SWG\Items(ref="#/definitions/User"))
         *         )
         *     )
         * )
         */
        // see https://github.com/silexphp/Silex/issues/149
        $controllers->get('/', 'service.user:getList');


        /**
         * @SWG\Get(
         *     path="/user/{userId}",
         *     tags={"user"},
         *     @SWG\Parameter(
         *          ref="#/parameters/userId"
         *     ),
         *     @SWG\Response(
         *          response="200",
         *          description="The User with the specified ID",
         *          @SWG\Schema(
         *              ref="#/definitions/User"
         *          )
         *     )
         * )
         */
        $controllers->get('/{userId}', 'service.user:getById');


        /**
         * @SWG\Post(
         *     description="Creates an user",
         *     tags={"user"},
         *     path="/user/",
         *     @SWG\Parameter(
         *          name="user",
         *          in="body",
         *          @SWG\Schema(
         *              ref="#/definitions/User"
         *          )
         *     ),
         *     @SWG\Response(
         *          response="200",
         *          description="The created User",
         *          @SWG\Schema(
         *              ref="#/definitions/User"
         *          )
         *      )
         * )
         */
        $controllers->post('/', 'service.user:create');

        return $controllers;
    }
}