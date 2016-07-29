<?php

namespace projectx\api\game;

use Silex\Application;
use Silex\ControllerCollection;
use Silex\ControllerProviderInterface;

/**
 * Class GameRoutesProvider
 * @package projectx\api\game
 */
class GameRoutesProvider implements ControllerProviderInterface
{

    /** {@inheritdoc} */
    public function connect(Application $app)
    {
        /** @var ControllerCollection $controllers */
        $controllers = $app['controllers_factory'];


        /**
         * @SWG\Get(
         *     path="/game/",
         *     tags={"game"},
         *     @SWG\Response(
         *         response="200",
         *         description="A List of all Games",
         *         @SWG\Schema(
         *              type="array",
         *              @SWG\Items(
         *                  ref="#/definitions/Game"
         *              )
         *         )
         *     )
         * )
         */
        $controllers->get('/', 'service.game:getList');


        /**
         * @SWG\Get(
         *     path="/game/{gameId}",
         *     tags={"game"},
         *     @SWG\Parameter(
         *          ref="#/parameters/gameId"
         *     ),
         *     @SWG\Response(
         *          response="200",
         *          description="The Game with the specified ID",
         *          @SWG\Schema(
         *              ref="#/definitions/Game")
         *          )
         *     )
         * )
         */
        $controllers->get('/{gameId}', 'service.game:getById');


        /**
         * @SWG\Get(
         *     path="/game/byGenre/{genre}",
         *     tags={"game"},
         *     @SWG\Parameter(
         *          ref="#/parameters/genre"
         *     ),
         *     @SWG\Response(
         *         response="200",
         *         description="A List of all Games with specified genre",
         *         @SWG\Schema(
         *              type="array",
         *              @SWG\Items(
         *                  ref="#/definitions/Game"
         *              )
         *         )
         *     )
         * )
         */
        $controllers->get('/byGenre/{genre}', 'service.game:getByGenre');


        /**
         * @SWG\Post(
         *     tags={"game"},
         *     path="/game/",
         *     @SWG\Parameter(
         *          name="game",
         *          in="body",
         *          @SWG\Schema(
         *              ref="#/definitions/Game"
         *          )
         *      ),
         *     @SWG\Response(
         *          response="201",
         *          description="The created Game",
         *          @SWG\Schema(ref="#/definitions/Game"))
         *     )
         * )
         */
        $controllers->post('/', 'service.game:create');

        return $controllers;
    }
}