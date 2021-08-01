<?php

namespace App\Tests\Unit\Controller;

use App\Infrastructure\Doctrine\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserLoggedinControllerTest extends WebTestCase
{
    public function testValidCredentials(): void
    {
        $client = static::createClient();

        $userRepository = static::getContainer()->get(UserRepository::class);
        $adminUser = $userRepository->findOneByEmail('miary@miary.dev');

        // Log in user
        $client->loginUser($adminUser);

        // user is now logged in, so you can test protected resources
        $client->request('GET', '/api/users/');
        $client->followRedirect();

        $this->assertResponseIsSuccessful();
    }
}
