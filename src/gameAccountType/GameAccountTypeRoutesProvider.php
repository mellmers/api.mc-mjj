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
         *     path="/gameAccountType/{gameAccountTypeId}",
         *     tags={"gameAccountType"},
         *     @SWG\Parameter(
         *          ref="#/parameters/gameAccountTypeId"
         *     ),
         *     @SWG\Response(
         *          response="200",
         *          description="The GameAccountType with the specified ID",
         *          @SWG\Schema(
         *              ref="#/definitions/GameAccountType"
         *          )
         *      )
         * )
         */
        $controllers->get('/{gameAccountTypeId}', 'service.gameAccountType:getById');

        /**
         * @SWG\Post(
         *     description="Creates a GameAccountType",
         *     tags={"gameAccountType"},
         *     path="/gameAccountType/",
         *     @SWG\Parameter(
         *          name="gameAccountType",
         *          in="body",
         *          @SWG\Schema(
         *              ref="#/definitions/GameAccountType"
         *          )
         *      ),
         *     @SWG\Response(
         *          response="201",
         *          description="The created GameAccountType",
         *          @SWG\Schema(
         *              ref="#/definitions/GameAccountType"
         *          )
         *     )
         *)
         */
        $controllers->post('/', 'service.gameAccountType:create');

        /**
         * @SWG\Get(
         *     path="/gameAccountType/delete/{gameAccountTypeID}",
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
        $controllers->get('/delete/{gameAccountTypeID}', 'service.gameAccountType:deleteGameAccountType');

        /**
         * @SWG\Patch(
         *     tags={"gameAccountType"},
         *     path="/gameAccountType/",
         *     @SWG\Parameter(
         *          ref="#/parameters/gameAccountTypeId"
         *     ),
         *     @SWG\Response(
         *          response="200",
         *          description="The created GameAccountType",
         *          @SWG\Schema(
         *              ref="#/definitions/GameAccountType"
         *          )
         *     )
         *)
         */
        $controllers->patch('/', 'service.gameAccountType:update');

        return $controllers;
    }
}