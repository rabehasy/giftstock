<?php

namespace App\DataFixtures;

use App\Domain\Receiver\Receiver;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ReceiverFixtures extends Fixture
{
    public static $receiver = [];

    public function load(ObjectManager $manager): void
    {
        $list = [
            [
                'first_name' => 'JANVIER',
                'last_name' => 'Lundi',
                'country_code' => 'FR',
            ],
            [
                'first_name' => 'FEVRIER',
                'last_name' => 'Mardi',
                'country_code' => 'NL',
            ],
            [
                'first_name' => 'MARS',
                'last_name' => 'Mercredi',
                'country_code' => 'ES',
            ],
            [
                'first_name' => 'AVRIL',
                'last_name' => 'Jeudi',
                'country_code' => 'GB',
            ],
            [
                'first_name' => 'MAI',
                'last_name' => 'Vendredi',
                'country_code' => 'DE',
            ],
            [
                'first_name' => 'JUIN',
                'last_name' => 'Samedi',
                'country_code' => 'IT',
            ],
            [
                'first_name' => 'JUILLET',
                'last_name' => 'Dimanche',
                'country_code' => 'PT',
            ],
        ];

        foreach ($list as $item) {
            $firstName = $item['first_name'] ?? '';

            $entity = new Receiver();
            $entity->setFirstName($firstName);
            $entity->setLastName($item['last_name'] ?? '');
            $entity->setCountryCode($item['country_code'] ?? '');

            $manager->persist($entity);
            $manager->flush();

            self::$receiver[$firstName] = $firstName;
            $this->addReference(self::$receiver[$firstName], $entity);
        }
    }
}
