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
         * @SWG\Parameter(name="game", type="integer", format="int32", in="path")
         * @SWG\Tag(name="game", description="All about games")
         */

        /**
         * @SWG\Get(
         *     path="/game/",
         *     tags={"game"},
         *     @SWG\Response(response="200", description="An example resource")
         * )
         */
        // see https://github.com/silexphp/Silex/issues/149
        $controllers->get('/', 'service.game:getList');

        /**
         * @SWG\Get(
         *     path="/game/{id}",
         *     tags={"game"},
         *     @SWG\Parameter(ref="#/parameters/gameId"),
         *     @SWG\Response(
         *         response="200",
         *         description="An example resource",
         *          @SWG\Schema(ref="#/definitions/game")
         *     )
         * )
         */
        $controllers->get('/{id}', 'service.game:getById');

        /**
         * @SWG\Get(
         *     path="/game/byGenre/{genre}",
         *     tags={"game"},
         *     @SWG\Parameter(ref="#/parameters/genre"),
         *     @SWG\Response(
         *         response="200",
         *         description="An example resource",
         *          @SWG\Schema(ref="#/definitions/game")
         *     )
         * )
         */
        $controllers->get('/byGenre/{genre}', 'service.game:getByGenre');

        /**
         * @SWG\Post(
         *     tags={"game"},
         *     path="/game/",
         *     @SWG\Parameter(name="game", in="body", @SWG\Schema(ref="#/definitions/game")),
         *     @SWG\Response(response="201", description="An example resource")
         * )
         *
         */
        $controllers->post('/', 'service.game:create');

        return $controllers;
    }
}