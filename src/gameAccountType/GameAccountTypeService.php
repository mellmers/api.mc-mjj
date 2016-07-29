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
     * @return JsonResponse
     */
    public function getList()
    {
        $result['data'] = $this->gameAccountTypeRepository->getAll();
        return new JsonResponse($result);
    }

    /**
     * GET /gameAccountType/{id}
     *
     * @param $gameAccountTypeId
     *
     * @return JsonResponse
     */
    public function getById($id)
    {
        $result['data'] = $this->gameAccountTypeRepository->getById($id);
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

        $gameAccountTypeFromDatabase = $this->gameAccountTypeRepository->create($gameAccountType);

        $response['data'] = $gameAccountTypeFromDatabase;

        return new JsonResponse($response, 201);
    }

    /**
     * PATCH /gameAccountType
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function update(Request $request)
    {
        $postData = $request->request->all();

        $gameAccountType = GameAccountType::createFromArray($postData);

        $gameAccountTypeFromDatabase = $this->gameAccountTypeRepository->update($gameAccountType);

        $response['data'] = $gameAccountTypeFromDatabase;

        return new JsonResponse($response, 200);
    }

    /**
     * GET /gameAccountType/delete/{gameAccountTypeID}
     *
     * @param $gameAccountTypeId
     *
     * @return JsonResponse
     */
    public function deleteGameAccountType($gameAccountTypeID)
    {
        $result['data'] = $this->gameAccountTypeRepository->deleteGameAccountType($gameAccountTypeID);
        return new JsonResponse($result);
    }
}