<?php

namespace projectx\api\user;

use projectx\api\entity\User;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

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
        return new JsonResponse($this->userRepository->getAll());
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
        unset($postData['id']);
        
        $user = User::createFromArray($postData);
        
        $this->userRepository->create($user);
        
        return new JsonResponse($user, 201);
    }
}