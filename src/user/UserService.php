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
     * @return JsonResponse
     *
     */
    public function getList()
    {
        $response['data'] = $this->userRepository->getAll();
        return new JsonResponse($response);
    }

    /**
     * GET /user/(userId)
     *
     * @param $userId
     *
     * @return JsonResponse
     */
    public function getById($userId)
    {
        $response['data'] = $this->userRepository->getById($userId);
        return new JsonResponse($response);
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

        $user = User::createFromArray($postData);

        $userFromDatabase = $this->userRepository->create($user);

        $response['data'] = $userFromDatabase;

        return new JsonResponse($response, 201);
    }

    /**
     * GET /user/delete/(userId)
     *
     * @param $userId
     *
     * @return JsonResponse
     */
    public function deleteUser($userId)
    {
        $response['data'] = $this->userRepository->deleteUser($userId);
        return new JsonResponse($response, 200);
    }
}