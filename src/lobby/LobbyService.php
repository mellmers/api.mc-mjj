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
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function getList()
    {
        $result['data'][] = $this->lobbyRepository->getAll();
        return new JsonResponse($result);
    }

    /**
     * @return JsonResponse
     * @throws DatabaseException
     * @internal param $id
     *
     */
    public function getById($id)
    {
        $result['data'][] = $this->lobbyRepository->getById($id);
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

        $lobby['data'][] = Lobby::createFromArray($postData);

        $this->lobbyRepository->create($lobby);

        return new JsonResponse($lobby, 201);
    }
}