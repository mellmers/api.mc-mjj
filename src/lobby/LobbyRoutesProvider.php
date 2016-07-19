<?php

namespace projectx\api\lobby;

use Silex\Application;
use Silex\ControllerCollection;
use Silex\ControllerProviderInterface;

/**
 * Class LobbyRoutesProvider
 * @package projectx\api\lobby
 */
class LobbyRoutesProvider implements ControllerProviderInterface
{

    /** {@inheritdoc} */
    public function connect(Application $app)
    {
        /** @var ControllerCollection $controllers */
        $controllers = $app['controllers_factory'];

        /**
         * @SWG\Parameter(name="lobby", type="integer", format="int32", in="path")
         * @SWG\Tag(name="lobby", description="All about lobbys")
         */

        /**
         * @SWG\Get(
         *     path="/lobby/",
         *     tags={"lobby"},
         *     @SWG\Response(response="200", description="An example resource")
         * )
         */
        // see https://github.com/silexphp/Silex/issues/149
        $controllers->get('/', 'service.lobby:getList');

        /**
         * @SWG\Get(
         *     path="/lobby/{id}",
         *     tags={"lobby"},
         *     @SWG\Parameter(ref="#/parameters/id"),
         *     @SWG\Response(
         *         response="200",
         *         description="An example resource",
         *          @SWG\Schema(ref="#/definitions/lobby")
         *     )
         * )
         */
        $controllers->get('/{id}', 'service.lobby:getById');

        /**
         * @SWG\Get(
         *     path="/lobby/byOwnerId/{ownerId}",
         *     tags={"lobby"},
         *     @SWG\Parameter(ref="#/parameters/ownerId"),
         *     @SWG\Response(
         *         response="200",
         *         description="An example resource",
         *          @SWG\Schema(ref="#/definitions/lobby")
         *     )
         * )
         */
        $controllers->get('/byOwnerId/{ownerId}', 'service.lobby:getByOwnerId');

        /**
         * @SWG\Get(
         *     path="/lobby/byGameId/{gameId}",
         *     tags={"lobby"},
         *     @SWG\Parameter(ref="#/parameters/gameId"),
         *     @SWG\Response(
         *         response="200",
         *         description="An example resource",
         *          @SWG\Schema(ref="#/definitions/lobby")
         *     )
         * )
         */
        $controllers->get('/byGameId/{gameId}', 'service.lobby:getByGameId');

        /**
         * @SWG\Post(
         *     tags={"lobby"},
         *     path="/lobby/",
         *     @SWG\Parameter(name="lobby", in="body", @SWG\Schema(ref="#/definitions/lobby")),
         *     @SWG\Response(response="201", description="An example resource")
         * )
         *
         */
        $controllers->post('/', 'service.lobby:create');

        return $controllers;
    }
}