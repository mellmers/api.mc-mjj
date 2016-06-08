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
        return new JsonResponse($this->gameAccountTypeRepository->getAll());
    }

    /**
     * @return JsonResponse
     * @throws DatabaseException
     * @internal param $name
     *
     */
    public function getByName($name)
    {
        return new JsonResponse($this->gameAccountTypeRepository->getByName($name));
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