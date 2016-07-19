<?php

namespace projectx\api\gameAccountType;

use projectx\api\entity\GameAccountType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class GameAccountTypeService
 * @package projectx\api\gameAccountType
 */
class GameAccountTypeService
{

    /** @var  GameAccountTypeRepository */
    private $gameAccountTypeRepository;

    /**
     * GameAccountTypeService constructor.
     *
     * @param GameAccountTypeRepository $gameAccountTypeRepository
     */
    public function __construct(GameAccountTypeRepository $gameAccountTypeRepository)
    {
        $this->gameAccountTypeRepository = $gameAccountTypeRepository;
    }

    /**
     * GET /gameAccountType
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function getList()
    {
        $result['data'][] = $this->gameAccountTypeRepository->getAll();
        return new JsonResponse($result);
    }

    /**
     * GET /gameAccountType/{id}
     *
     * @return JsonResponse
     * @throws DatabaseException
     * @internal param $id
     */
    public function getById($id)
    {
        $result['data'][] = $this->gameAccountTypeRepository->getById($id);
        return new JsonResponse($result);
    }


    /**
     * POST /gameAccountType
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function create(Request $request)
    {
        $postData = $request->request->all();

        $gameAccountType = GameAccountType::createFromArray($postData);

        $this->gameAccountTypeRepository->create($gameAccountType);

        return new JsonResponse($gameAccountType, 201);
    }
}