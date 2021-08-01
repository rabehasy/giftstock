<?php

namespace App\Tests\Unit\Entity;

use App\Domain\Receiver\Receiver;
use PHPUnit\Framework\TestCase;

class ReceiverTest extends TestCase
{
    // Last name and first name are filled
    public function testNames(): void
    {
        $entity = new Receiver();
        $entity->setFirstName('DURAND');
        $entity->setLastName('Pierre');

        $this->assertEquals('DURAND Pierre', $entity->getNames());
    }

    // Last name only
    public function testEmptyFirstname(): void
    {
        $entity = new Receiver();
        $entity->setLastName('Pierre');

        $this->assertEquals('Pierre', $entity->getNames());
    }

    // First name only
    public function testEmptyLastname(): void
    {
        $entity = new Receiver();
        $entity->setFirstName('DURAND');

        $this->assertEquals('DURAND', $entity->getNames());
    }

    // empty names
    public function testEmptyNames(): void
    {
        $entity = new Receiver();

        $this->assertEquals('', $entity->getNames());
    }
}
