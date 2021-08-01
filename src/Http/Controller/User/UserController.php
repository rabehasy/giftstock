<?php

namespace App\Http\Controller\User;

use App\Application\CreateUserHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/users")
 */
class UserController extends AbstractController
{
    /**
     * @var CreateUserHandler
     */
    private $handler;

    public function __construct(CreateUserHandler $handler)
    {
        $this->handler = $handler;
    }

    /**
     * @Route("/", name="api_user_create", methods={"POST"})
     */
    public function create(Request $request): JsonResponse
    {
        $user = json_decode($request->getContent(), true);

        try {
            $this->handler->handle([
                'email' => $user['email'],
                'password' => $user['password'],
            ]);
        } catch (\Exception $exception) {
            return new JsonResponse($exception->getMessage());
        }

        return new JsonResponse('user successfully created');
    }
}
