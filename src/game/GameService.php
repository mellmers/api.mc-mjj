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
    /** @var  GameRepository */
    private $gameRepository;

    /**
     * GameService constructor.
     *
     * @param GameRepository $gameRepository
     * @param
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
    public function getById($gameId)
    {
        $result['data'] = $this->gameRepository->getById($gameId);
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

        $game = Game::createFromArray($postData);

        $gameFromDatabase = $this->gameRepository->create($game);

        $response['data'] = $gameFromDatabase;

        return new JsonResponse($response, 201);
    }

    /**
     * PATCH /game
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function update(Request $request)
    {
        $postData = $request->request->all();

        $game = Game::createFromArray($postData);

        $gameFromDatabase = $this->gameRepository->update($game);

        $response['data'] = $gameFromDatabase;
    }

    /**
     * GET /game/delete/{gameId)
     *
     * @param $gameId
     *
     * @return JsonResponse
     */
    public function deleteGame($gameId)
    {
        $response['data'] = $this->gameRepository->deleteGame($gameId);
        return new JsonResponse($response, 200);
    }
}