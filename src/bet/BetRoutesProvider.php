<?php

namespace projectx\api\bet;

use Silex\Application;
use Silex\ControllerCollection;
use Silex\ControllerProviderInterface;

/**
 * Class BetRoutesProvider
 * @package projectx\api\bet
 */
class BetRoutesProvider implements ControllerProviderInterface
{

    /** {@inheritdoc} */
    public function connect(Application $app)
    {
        /** @var ControllerCollection $controllers */
        $controllers = $app['controllers_factory'];

        /**
         * @SWG\Parameter(name="bet", type="integer", format="int32", in="path")
         * @SWG\Tag(name="bet", description="All about bets")
         */

        /**
         * @SWG\Get(
         *     path="/bet/",
         *     tags={"bet"},
         *     @SWG\Response(response="200", description="An example resource")
         * )
         */
        // see https://github.com/silexphp/Silex/issues/149
        $controllers->get('/', 'service.bet:getList');
        /**
         * @SWG\Get(
         *     path="/bet/{id}",
         *     tags={"bet"},
         *     @SWG\Parameter(ref="#/parameters/id"),
         *     @SWG\Response(
         *         response="200",
         *         description="An example resource",
         *          @SWG\Schema(ref="#/definitions/bet")
         *     )
         * )
         */
        $controllers->get('/{userId},{lobbyId}', 'service.bet:getByIds');

        /**
         * @SWG\Post(
         *     tags={"bet"},
         *     path="/bet/",
         *     @SWG\Parameter(name="bet", in="body", @SWG\Schema(ref="#/definitions/bet")),
         *     @SWG\Response(response="201", description="An example resource")
         * )
         *
         */
        $controllers->post('/', 'service.bet:create');

        return $controllers;
    }
}