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
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function getList()
    {
        $result['data'][] = $this->gameAccountRepository->getAll();
        return new JsonResponse($result);
    }

    /**
     * @return JsonResponse
     * @throws DatabaseException
     * @internal param $id
     * @internal param $type
     *
     */
    public function getByIdAndType($id, $type)
    {
        $result['data'][] = $this->gameAccountRepository->getByIdAndType($id, $type);
        return new JsonResponse($result);
    }

    /**
     * @return JsonResponse
     * @throws DatabaseException
     * @internal param $userId
     *
     */
    public function getByUserId($userId)
    {
        $result['data'][] = $this->gameAccountRepository->getByUserId($userId);
        return new JsonResponse($result);
    }

    /**
     * @return JsonResponse
     * @throws DatabaseException
     * @internal param $gameAccountTypeId
     *
     */
    public function getByTypeId($gameAccountTypeId)
    {
        $result['data'][] = $this->gameAccountRepository->getByTypeId($gameAccountTypeId);
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

        $gameAccount = GameAccount::createFromArray($postData);

        $this->gameAccountRepository->create($gameAccount);

        return new JsonResponse($gameAccount, 201);
        $result['data'][] = $gameAccount;
        return new JsonResponse($result, 201);
    }
}