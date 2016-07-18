<?php

namespace projectx\api\user;

use projectx\api\entity\User;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class UserService
 * @package projectx\api\user
 */
class UserService
{

    /** @var  UserRepository */
    private $userRepository;

    /**
     * UserService constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * GET /user
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function getList()
    {
        $result['data'] = $this->userRepository->getAll();
        return new JsonResponse($result);
    }

    /**
     * @return JsonResponse
     * @throws DatabaseException
     * @internal param $userId
     *
     */
    public function getById($userId)
    {
        $result['data'] = $this->userRepository->getById($userId);
        return new JsonResponse($result);
    }


    /**
     * POST /user
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function create(Request $request)
    {
        $postData = $request->request->all();

        $user['data'] = User::createFromArray($postData);

        $this->userRepository->create($user);

        return new JsonResponse($user, 201);
    }
}