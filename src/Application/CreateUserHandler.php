<?php

namespace App\Application;

use App\Domain\User\User;
use App\Domain\User\UserRepositoryInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class CreateUserHandler
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;
    /**
     * @var UserPasswordHasherInterface
     */
    private $hasher;

    public function __construct(UserRepositoryInterface $userRepository, UserPasswordHasherInterface $hasher)
    {
        $this->userRepository = $userRepository;
        $this->hasher = $hasher;
    }

    public function handle(array $item): void
    {
        $user = new User();
        $user->setEmail($item['email']);
        $user->setPassword($this->hasher->hashPassword($user, $item['password']));

        try {
            $this->userRepository->save($user);
        } catch (\Exception $exception) {
            throw new \Exception('unable to save user '.$item['email'].' - '.$exception->getMessage());
        }
    }
}
