<?php

namespace projectx\api\game;

use projectx\api\entity\Game;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class GameService
 * @package projectx\api\game
 */
class GameService
{
    /**
     * @SWG\Parameter(name="gameId", in="path", type="integer", description="")
     * @SWG\Parameter(name="genre", in="path", type="string", description="")
     */

    /** @var  GameRepository */
    private $gameRepository;

    /**
     * GameService constructor.
     *
     * @param GameRepository $gameRepository
     */
    public function __construct(GameRepository $gameRepository)
    {
        $this->gameRepository = $gameRepository;
    }

    /**
     * GET /game
     *
     * @return JsonResponse
     */
    public function getList()
    {
        $result['data'] = $this->gameRepository->getAll();
        return new JsonResponse($result);
    }

    /**
     * GET /game/{gameId}
     *
     * @param $gameId
     *
     * @return JsonResponse
     */
    public function getById($id)
    {
        $result['data'] = $this->gameRepository->getById($id);
        return new JsonResponse($result);
    }

    /**
     * GET /game/byGenre/{genre}
     *
     * @param $genre
     *
     * @return JsonResponse
     */
    public function getByGenre($genre)
    {
        $result['data'] = $this->gameRepository->getByGenre($genre);
        return new JsonResponse($result);
    }

    /**
     * POST /game
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function create(Request $request)
    {
        $postData = $request->request->all();

        $game['data'] = Game::createFromArray($postData);

        $this->gameRepository->create($game);

        return new JsonResponse($game, 201);

    }
}