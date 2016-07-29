<?php

namespace projectx\api\gameAccountType;

use Silex\Application;
use Silex\ControllerCollection;
use Silex\ControllerProviderInterface;

/**
 * Class GameAccountTypeRoutesProvider
 * @package projectx\api\gameAccountType
 */
class GameAccountTypeRoutesProvider implements ControllerProviderInterface
{

    /** {@inheritdoc} */
    public function connect(Application $app)
    {
        /** @var ControllerCollection $controllers */
        $controllers = $app['controllers_factory'];


        /**
         * @SWG\Get(
         *     path="/gameAccountType/",
         *     tags={"gameAccountType"},
         *     @SWG\Response(
         *         response="200",
         *         description="A List of all Game Account Type",
         *         @SWG\Schema(
         *              type="array",
         *              @SWG\Items(
         *                  ref="#/definitions/GameAccountType"
         *              )
         *         )
         *     )
         * )
         */
        $controllers->get('/', 'service.gameAccountType:getList');

        /**
         * @SWG\Get(
         *     path="/gameAccountType/{id}",
         *     tags={"gameAccountType"},
         *     @SWG\Response(
         *          response="200",
         *          description="The GameAccountType with the specified ID",
         *          @SWG\Schema(
         *              ref="#/definitions/GameAccountType"
         *          )
         *      )
         * )
         */
        $controllers->get('/{id}', 'service.gameAccountType:getById');

        /**
         * @SWG\Post(
         *     tags={"gameAccountType"},
         *     path="/gameAccountType/",
         *     @SWG\Parameter(
         *          name="gameAccountType", in="body",
         *          @SWG\Schema(
         *              ref="#/definitions/GameAccountType"
         *          )
         *      ),
         *     @SWG\Response(
         *          response="200",
         *          description="The created GameAccountType",
         *          @SWG\Schema(
         *              ref="#/definitions/GameAccountType"
         *          )
         *     )
         *)
         */
        $controllers->post('/', 'service.gameAccountType:create');

        return $controllers;
    }
}