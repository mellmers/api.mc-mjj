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
         * @SWG\Get(
         *     path="/gameAccount/",
         *     tags={"gameAccount"},
         *     @SWG\Response(
         *         response="200",
         *         description="A List of all GameAccounts",
         *         @SWG\Schema(
         *              type="array",
         *              @SWG\Items(
         *                  ref="#/definitions/GameAccount"
         *              )
         *         )
         *     )
         * )
         */
        $controllers->get('/', 'service.gameAccount:getList');


        /**
         * @SWG\Get(
         *     path="/gameAccount/{userId},{gameAccountTypeId}",
         *     tags={"gameAccount"},
         *     @SWG\Parameter(
         *          ref="#/parameters/userId"
         *     ),
         *     @SWG\Parameter(
         *          ref="#/parameters/gameAccountTypeId"
         *     ),
         *     @SWG\Response(
         *          response="200",
         *          description="The Game Account with the specified ID and Type",
         *          @SWG\Schema(
         *              ref="#/definitions/GameAccount"
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
         *         description="A List of all GameAccounts of a User",
         *         @SWG\Schema(
         *              type="array",
         *              @SWG\Items(
         *                  ref="#/definitions/GameAccount"
         *              )
         *         )
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
         *         description="A List of all GameAccounts of a Type",
         *         @SWG\Schema(
         *              type="array",
         *              @SWG\Items(
         *                  ref="#/definitions/GameAccount"
         *              )
         *         )
         *     )
         * )
         */
        $controllers->get('/byTypeId/{gameAccountTypeId}', 'service.gameAccount:getByTypeId');

        /**
         * @SWG\Post(
         *     description="Creates a Game Account",
         *     tags={"gameAccount"},
         *     path="/gameAccount/",
         *     @SWG\Parameter(
         *          name="gameAccount",
         *          in="body",
         *          @SWG\Schema(
         *              ref="#/definitions/GameAccount"
         *          )
         *      ),
         *     @SWG\Response(
         *          response="201",
         *          description="The created Game Account",
         *          @SWG\Schema(
         *              ref="#/definitions/GameAccount"
         *          )
         *     )
         * )
         *
         */
        $controllers->post('/', 'service.gameAccount:create');

        /**
         * @SWG\Get(
         *     description="Deletes the Game Account with the specified ID and Type",
         *     path="/gameAccount/delete/{userId},{gameAccountTypeId}",
         *     tags={"gameAccount"},
         *     @SWG\Parameter(
         *          ref="#/parameters/userId"
         *     ),
         *     @SWG\Parameter(
         *          ref="#/parameters/gameAccountTypeId"
         *     ),
         *     @SWG\Response(
         *          response="200",
         *          description="The deleted Game Account",
         *          @SWG\Schema(
         *              ref="#/definitions/GameAccount"
         *          )
         *     )
         * )
         */
        $controllers->get('/delete/{userId},{gameAccountTypeId}', 'service.gameAccount:deleteGameAccount');

        /**
         * @SWG\Patch(
         *     description="Updates a Game Account",
         *     tags={"gameAccount"},
         *     path="/gameAccount/",
         *     @SWG\Parameter(
         *          name="gameAccount",
         *          in="body",
         *          @SWG\Schema(
         *              ref="#/definitions/GameAccount"
         *          )
         *      ),
         *     @SWG\Response(
         *          response="200",
         *          description="The created Game Account",
         *          @SWG\Schema(
         *              ref="#/definitions/GameAccount"
         *          )
         *     )
         * )
         *
         */
        $controllers->patch('/', 'service.gameAccount:update');

        return $controllers;
    }
}