<?php

namespace App\Http\Controller\User;

use App\Application\CreateUserHandler;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class UserController
{
    /**
     * @var CreateUserHandler
     */
    private $handler;

    public function __construct(CreateUserHandler $handler)
    {
        $this->handler = $handler;
    }

    public function index(Request $request): JsonResponse
    {
        $user = json_decode($request->getContent(), true);

        try {
            $this->handler->handle([
                'username' => $user['username'],
                'password' => $user['password'],
            ]);
        } catch (\Exception $exception) {
            return new JsonResponse($exception->getMessage());
        }

        return new JsonResponse('user successfully created');
    }
}
