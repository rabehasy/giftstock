<?php

namespace App\Http\Controller\User;

use App\Application\User\CreateUserHandler;
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
     * @Route("/", name="api_user_create", methods={"POST"})
     */
    public function create(Request $request, CreateUserHandler $handler): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        try {
            $handler->handle([
                'email' => $data['email'],
                'password' => $data['password'],
            ]);
        } catch (\Exception $exception) {
            return new JsonResponse($exception->getMessage());
        }

        return new JsonResponse('user successfully created');
    }
}
