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
         * @SWG\Get(
         *     path="/lobby/",
         *     tags={"lobby"},
         *     @SWG\Response(
         *         response="200",
         *         description="A List of all Lobbies",
         *         @SWG\Schema(
         *              type="array",
         *              @SWG\Items(
         *                  ref="#/definitions/Lobby"
         *              )
         *         )
         *     )
         * )
         */
        $controllers->get('/', 'service.lobby:getList');


        /**
         * @SWG\Get(
         *     path="/lobby/{lobbyId}",
         *     tags={"lobby"},
         *     @SWG\Parameter(
         *          ref="#/parameters/lobbyId"
         *     ),
         *     @SWG\Response(
         *          response="200",
         *          description="The Lobby with the specified ID",
         *          @SWG\Schema(
         *              ref="#/definitions/Lobby"
         *          )
         *      )
         * )
         */
        $controllers->get('/{lobbyId}', 'service.lobby:getById');

        /**
         * @SWG\Get(
         *     path="/lobby/withAllUsers/{lobbyId}",
         *     tags={"lobby"},
         *     @SWG\Parameter(
         *          ref="#/parameters/lobbyId"
         *     ),
         *     @SWG\Response(
         *          response="200",
         *          description="The Lobby with the specified ID and all its Users",
         *          @SWG\Schema(
         *              ref="#/definitions/Lobby"
         *          )
         *      )
         * )
         */
        $controllers->get('/withAllUsers/{lobbyId}', 'service.lobby:getByIdWithAllUsers');

        /**
         * @SWG\Get(
         *     path="/lobby/byOwnerId/{userId}",
         *     tags={"lobby"},
         *     @SWG\Parameter(ref="#/parameters/userId"),
         *     @SWG\Response(
         *         response="200",
         *         description="A List of all Lobbies of a User",
         *         @SWG\Schema(
         *              type="array",
         *              @SWG\Items(
         *                  ref="#/definitions/Lobby"
         *              )
         *         )
         *     )
         * )
         */
        $controllers->get('/byOwnerId/{userId}', 'service.lobby:getByOwnerId');


        /**
         * @SWG\Get(
         *     path="/lobby/byGameId/{gameId}",
         *     tags={"lobby"},
         *     @SWG\Parameter(ref="#/parameters/gameId"),
         *     @SWG\Response(
         *         response="200",
         *         description="A List of all Lobbies of a Game",
         *         @SWG\Schema(
         *              type="array",
         *              @SWG\Items(
         *                  ref="#/definitions/Lobby"
         *              )
         *         )
         *     )
         * )
         */
        $controllers->get('/byGameId/{gameId}', 'service.lobby:getByGameId');


        /**
         * @SWG\Post(         *
         *     description="Creates a Lobby",
         *     tags={"lobby"},
         *     path="/lobby/",
         *     @SWG\Parameter(
         *          name="lobby",
         *          in="body",
         *          @SWG\Schema(
         *              ref="#/definitions/Lobby"
         *          ),
         *     @SWG\Response(
         *          response="200",
         *          description="The created Lobby",
         *          @SWG\Schema(
         *              ref="#/definitions/Lobby"
         *          )
         *     )
         * )
         *
         */
        $controllers->post('/', 'service.lobby:create');

        return $controllers;
    }
}