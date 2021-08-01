<?php

namespace App\Tests\Unit\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LoginControllerTest extends WebTestCase
{
    public function testSuccessfullPage(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api');

        $this->assertResponseIsSuccessful();
    }
}
