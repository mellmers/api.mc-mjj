<?php

namespace projectx\api\gameAccount;

use projectx\api\entity\GameAccount;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class GameAccountService
 * @package projectx\api\gameAccount
 */
class GameAccountService
{
    /** @var  GameAccountRepository */
    private $gameAccountRepository;

    /**
     * GameAccountService constructor.
     *
     * @param GameAccountRepository $gameAccountRepository
     */
    public function __construct(GameAccountRepository $gameAccountRepository)
    {
        $this->gameAccountRepository = $gameAccountRepository;
    }

    /**
     * GET /gameAccount
     *
     * @return JsonResponse
     */
    public function getList()
    {
        $result['data'] = $this->gameAccountRepository->getAll();
        return new JsonResponse($result);
    }

    /**
     * GET /gameAccount/{userId},{gameAccountTypeId}
     *
     * @param $userId
     * @param $gameAccountTypeId
     *
     * @return JsonResponse
     */
    public function getByIdAndType($userId, $gameAccountTypeId)
    {
        $result['data'] = $this->gameAccountRepository->getByIdAndType($userId, $gameAccountTypeId);
        return new JsonResponse($result);
    }

    /**
     * GET /gameAccount/byUserId/{userId}
     *
     * @param $userId
     *
     * @return JsonResponse
     */
    public function getByUserId($userId)
    {
        $result['data'] = $this->gameAccountRepository->getByUserId($userId);
        return new JsonResponse($result);
    }

    /**
     * GET /gameAccount/byTypeId/{gameAccountTypeId}
     *
     * @param $gameAccountTypeId
     *
     * @return JsonResponse
     */
    public function getByTypeId($gameAccountTypeId)
    {
        $result['data'] = $this->gameAccountRepository->getByTypeId($gameAccountTypeId);
        return new JsonResponse($result);
    }

    /**
     * POST /gameAccount
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function create(Request $request)
    {
        $postData = $request->request->all();

        $gameAccount['data'] = GameAccount::createFromArray($postData);

        $this->gameAccountRepository->create($gameAccount);

        return new JsonResponse($gameAccount, 201);
    }
}