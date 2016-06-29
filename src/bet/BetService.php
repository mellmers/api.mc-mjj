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
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function getList()
    {
        return new JsonResponse($this->betRepository->getAll());
    }

    /**
     * @return JsonResponse
     * @throws DatabaseException
     * @internal param $userId
     * @internal param $lobbyId
     */
    public function getByIds($userId, $lobbyId)
    {
        return new JsonResponse($this->betRepository->getByIds($userId, $lobbyId));
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

        $this->betRepository->create($bet);

        return new JsonResponse($bet, 201);
    }
}