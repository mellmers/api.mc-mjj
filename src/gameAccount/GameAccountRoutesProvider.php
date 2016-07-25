<?php

namespace projectx\api\gameAccount;

use Silex\Application;
use Silex\ControllerCollection;
use Silex\ControllerProviderInterface;

/**
 * Class GameAccountRoutesProvider
 * @package projectx\api\gameAccount
 */
class GameAccountRoutesProvider implements ControllerProviderInterface
{

    /** {@inheritdoc} */
    public function connect(Application $app)
    {
        /** @var ControllerCollection $controllers */
        $controllers = $app['controllers_factory'];

        /**
         * 
         * @SWG\Tag(name="gameAccount", description="All about gameAccounts")
         */

        /**
         * @SWG\Get(
         *     path="/gameAccount/",
         *     tags={"gameAccount"},
         *     @SWG\Response(response="200", description="An example resource")
         * )
         */
        // see https://github.com/silexphp/Silex/issues/149
        $controllers->get('/', 'service.gameAccount:getList');
        /**
         * @SWG\Get(
         *     path="/gameAccount/{userId},{gameAccountTypeId}",
         *     tags={"gameAccount"},
         *     @SWG\Parameter(ref="#/parameters/userId"),
         *     @SWG\Parameter(ref="#/parameters/gameAccountTypeId"),
         *     @SWG\Response(
         *         response="200",
         *         description="An example resource",
         *          @SWG\Schema(
         *              @SWG\Property(
         *                      property="status",
         *                      type="string",
         *                      default="success"
         *                  )
         *          )
         *     )
         * )
         */
        $controllers->get('/{userId},{gameAccountTypeId}', 'service.gameAccount:getByIdAndType');

        /**
         * @SWG\Get(
         *     path="/gameAccount/byUserId/{userId}",
         *     tags={"gameAccount"},
         *     @SWG\Parameter(ref="#/parameters/userId"),
         *     @SWG\Response(
         *         response="200",
         *         description="An example resource",
         *          @SWG\Schema(
         *              @SWG\Property(
         *                      property="status",
         *                      type="string",
         *                      default="success"
         *                  )
         *          )
         *     )
         * )
         */
        $controllers->get('/byUserId/{userId}', 'service.gameAccount:getByUserId');

        /**
         * @SWG\Get(
         *     path="/gameAccount/byTypeId/{gameAccountTypeId}",
         *     tags={"gameAccount"},
         *     @SWG\Parameter(ref="#/parameters/gameAccountTypeId"),
         *     @SWG\Response(
         *         response="200",
         *         description="An example resource",
         *          @SWG\Schema(
         *              @SWG\Property(
         *                      property="status",
         *                      type="string",
         *                      default="success"
         *                  )
         *          )
         *     )
         * )
         */
        $controllers->get('/byTypeId/{gameAccountTypeId}', 'service.gameAccount:getByTypeId');

        /**
         * @SWG\Post(
         *     tags={"gameAccount"},
         *     path="/gameAccount/",
         *     @SWG\Parameter(name="gameAccount", in="body", @SWG\Schema(ref="#/parameters/gameAccount")),
         *     @SWG\Response(response="201", description="An example resource")
         * )
         *
         */
        $controllers->post('/', 'service.gameAccount:create');

        return $controllers;
    }
}