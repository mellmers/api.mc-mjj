<?php

namespace projectx\api\bet;

use projectx\api\entity\Bet;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class BetService
 * @package projectx\api\bet
 */
class BetService
{
    /** @var  BetRepository */
    private $betRepository;

    /**
     * BetService constructor.
     *
     * @param BetRepository $betRepository
     */
    public function __construct(BetRepository $betRepository)
    {
        $this->betRepository = $betRepository;
    }

    /**
     * GET /bet
     *
     * @return JsonResponse
     */
    public function getList()
    {
        $result['data'] = $this->betRepository->getAll();
        return new JsonResponse($result);
    }

    /**
     * GET /bet/{userId}{lobbyId}
     *
     * @param $userId
     * @param $lobbyId
     *
     * @return JsonResponse
     */
    public function getByIds($userId, $lobbyId)
    {
        $result['data'][] = $this->betRepository->getByIds($userId, $lobbyId);
        return new JsonResponse($result);
    }

    /**
     * GET /bet/byLobbyId/{lobbyId}
     *
     * @param $lobbyId
     *
     * @return JsonResponse
     */
    public function getByLobbyId($lobbyId)
    {
        $result['data'] = $this->betRepository->getByLobbyId($lobbyId);
        return new JsonResponse($result);
    }

    /**
     * GET /bet/byUserId/{userId}
     *
     * @param $userId
     *
     * @return JsonResponse
     */
    public function getByUserId($userId)
    {
        $result['data'] = $this->betRepository->getByUserId($userId);
        return new JsonResponse($result);
    }

    /**
     * POST /bet
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function create(Request $request)
    {
        $postData = $request->request->all();

        $bet = Bet::createFromArray($postData);

        $betFromDatabase = $this->betRepository->create($bet);

        $response['data'][] = $betFromDatabase;

        return new JsonResponse($response, 201);
    }


    /**
     * PATCH /bet
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function update(Request $request)
    {
        $postData = $request->request->all();

        $bet = Bet::createFromArray($postData);

        $betFromDatabase = $this->betRepository->update($bet);

        $response['data'] = $betFromDatabase;

        return new JsonResponse($response, 200);
    }


    /**
     * GET /bet/delete/{userId},{lobbyId}
     *
     * @param $userId
     * @param $lobbyId
     *
     * @return JsonResponse
     */
    public function deleteBet($userId, $lobbyId)
    {
        $result['data'] = $this->betRepository->deleteBet($userId, $lobbyId);
        return new JsonResponse($result);
    }
}