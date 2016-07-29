<?php

namespace projectx\api\lobby;

use projectx\api\entity\Lobby;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class LobbyService
 * @package projectx\api\lobby
 */
class LobbyService
{
    /** @var  LobbyRepository */
    private $lobbyRepository;

    /**
     * LobbyService constructor.
     *
     * @param LobbyRepository $lobbyRepository
     */
    public function __construct(LobbyRepository $lobbyRepository)
    {
        $this->lobbyRepository = $lobbyRepository;
    }

    /**
     * GET /lobby
     *
     * @return JsonResponse
     */
    public function getList()
    {
        $result['data'] = $this->lobbyRepository->getAll();
        return new JsonResponse($result);
    }

    /**
     * GET /lobby/{lobbyId}
     *
     * @param $lobbyId
     *
     * @return JsonResponse
     */
    public function getById($lobbyId)
    {
        $result['data'] = $this->lobbyRepository->getById($lobbyId);
        return new JsonResponse($result);
    }

    /**
     * GET /lobby/withAllUsers/{lobbyId}
     *
     * @param $lobbyId
     *
     * @return JsonResponse
     */
    public function getByIdWithAllUsers($lobbyId)
    {
        $result['data'] = $this->lobbyRepository->getByIdWithAllUsers($lobbyId);
        return new JsonResponse($result);
    }

    /**
     * GET /lobby/byOwnerId/{ownerId}
     *
     * @param $userId
     *
     * @return JsonResponse
     */
    public function getByOwnerId($userId)
    {
        $result['data'] = $this->lobbyRepository->getByOwnerId($userId);
        return new JsonResponse($result);
    }

    /**
     * GET /lobby/byGameId/{gameId}
     *
     * @param $gameId
     *
     * @return JsonResponse
     */
    public function getByGameId($gameId)
    {
        $result['data'] = $this->lobbyRepository->getByGameId($gameId);
        return new JsonResponse($result);
    }

    /**
     * GET /lobby/delete/{lobbyId}
     *
     * @param $lobbyId
     *
     * @return JsonResponse
     */
    public function deleteLobby($lobbyId)
    {
        $result['data'] = $this->lobbyRepository->deleteLobby($lobbyId);
        return new JsonResponse($result);
    }

    /**
     * POST /lobby
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function create(Request $request)
    {
        $postData = $request->request->all();

        $lobby = Lobby::createFromArray($postData);

        $lobbyFromDatabase = $this->lobbyRepository->create($lobby);

        $response['data'] = $lobbyFromDatabase;

        return new JsonResponse($response, 201);
    }
}