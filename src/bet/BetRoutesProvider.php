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
         * @SWG\Get(
         *     path="/bet/",
         *     tags={"bet"},
         *     @SWG\Response(
         *          response="200",
         *          description="A List of all Bets",
         *          @SWG\Schema(
         *              type="array",
         *              @SWG\Items(ref="#/definitions/Bet"))
         *          )
         *     )
         * )
         */
        $controllers->get('/', 'service.bet:getList');

        /**
         * @SWG\Get(
         *     path="/bet/{userId},{lobbyId}",
         *     tags={"bet"},
         *     @SWG\Parameter(
         *          ref="#/parameters/userId"
         *     ),
         *     @SWG\Parameter(
         *          ref="#/parameters/lobbyId"
         *     ),
         *     @SWG\Response(
         *          response="200",
         *          description="The Bet with the specified user and lobby",
         *          @SWG\Schema(
         *              ref="#/definitions/Bet"
         *          )
         *     )
         * )
         */
        $controllers->get('/{userId},{lobbyId}', 'service.bet:getByIds');


        /**
         * @SWG\Get(
         *     path="/bet/byUserId/{userId}",
         *     tags={"bet"},
         *     @SWG\Parameter(ref="#/parameters/userId"),
         *     @SWG\Response(
         *         response="200",
         *         description="A List of all Bets of a user",
         *         @SWG\Schema(
         *              type="array",
         *              @SWG\Items(
         *                  ref="#/definitions/Bet"
         *              )
         *         )
         *     )
         * )
         */
        $controllers->get('/byUserId/{userId}', 'service.bet:getByUserId');


        /**
         * @SWG\Get(
         *     path="/bet/byLobbyId/{lobbyId}",
         *     tags={"bet"},
         *     @SWG\Parameter(ref="#/parameters/lobbyId"),
         *     @SWG\Response(
         *         response="200",
         *         description="A List of all Bets of a lobby",
         *         @SWG\Schema(
         *              type="array",
         *              @SWG\Items(
         *                  ref="#/definitions/Bet"
         *              )
         *          )
         *     )
         * )
         */
        $controllers->get('/byLobbyId/{lobbyId}', 'service.bet:getByLobbyId');
        

        /**
         * @SWG\Post(
         *     description="Creates an user",
         *     tags={"bet"},
         *     path="/bet/",
         *     @SWG\Parameter(
         *          name="bet",
         *          in="body",
         *          @SWG\Schema(
         *              ref="#/definitions/Bet"
         *          )
         *      ),
         *     @SWG\Response(
         *          response="200",
         *          description="The created Bet",
         *          @SWG\Schema(
         *              ref="#/definitions/Bet"
         *          )
         *     )
         * )
         */
        $controllers->post('/', 'service.bet:create');

        /**
         * @SWG\Get(
         *     path="/bet/delete/{userId},{lobbyId}",
         *     tags={"bet"},
         *     @SWG\Parameter(
         *          ref="#/parameters/userId"
         *     ),
         *     @SWG\Parameter(
         *          ref="#/parameters/lobbyId"
         *     ),
         *     @SWG\Response(
         *          response="200",
         *          description="Deletes the bet with the specified owner ID and lobby id",
         *          @SWG\Schema(
         *              ref="#/definitions/Bet"
         *          )
         *     )
         * )
         */
        $controllers->get('/delete/{userId},{lobbyId}', 'service.bet:deleteBet');

        /**
         * @SWG\Patch(
         *     description="Updates an user",
         *     tags={"bet"},
         *     path="/bet/",
         *     @SWG\Parameter(
         *          name="bet",
         *          in="body",
         *          @SWG\Schema(
         *              ref="#/definitions/Bet"
         *          )
         *      ),
         *     @SWG\Response(
         *          response="200",
         *          description="The updated Bet",
         *          @SWG\Schema(
         *              ref="#/definitions/Bet"
         *          )
         *     )
         * )
         */
        $controllers->patch('/', 'service.bet:update');

        return $controllers;
    }
}