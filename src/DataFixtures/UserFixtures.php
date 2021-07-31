<?php

namespace App\DataFixtures;

use App\Domain\User\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    /**
     * @var UserPasswordHasherInterface
     */
    private $encoder;

    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager): void
    {
        $list = [
            [
                'email' => 'miary@miary.dev',
                'password' => 'test',
            ],
        ];

        foreach ($list as $item) {
            $user = new User();
            $user->setEmail($item['email']);

            $password = $this->encoder->hashPassword($user, $item['password']);
            $user->setPassword($password);

            $manager->persist($user);

            $manager->flush();
        }
    }
}
