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
        return new JsonResponse($this->gameAccountRepository->getAll());
    }

    /**
     * @return JsonResponse
     * @throws DatabaseException
     * @internal param $id
     * @internal param $type
     *
     */
    public function getByIdAndType($id,$type)
    {
        return new JsonResponse($this->gameAccountRepository->getByIdAndType($id,$type));
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
    }
}