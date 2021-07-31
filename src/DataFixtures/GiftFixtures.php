<?php

namespace App\DataFixtures;

use App\Domain\Gift\Gift;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class GiftFixtures extends Fixture
{
    public static $gift = [];

    public function load(ObjectManager $manager): void
    {
        $list = [
            [
                'code' => 'animal',
                'description' => 'animal description',
                'price' => 5,
            ],
            [
                'code' => 'car',
                'description' => 'car description',
                'price' => 10.5,
            ],
            [
                'code' => 'game',
                'description' => 'game description',
                'price' => 15,
            ],
            [
                'code' => 'garden',
                'description' => 'garden description',
                'price' => 20.45,
            ],
            [
                'code' => 'sport',
                'description' => 'sport description',
                'price' => 25,
            ],
            [
                'code' => 'grocery',
                'description' => 'grocery description',
                'price' => 30,
            ],
            [
                'code' => 'hardware',
                'description' => 'hardware description',
                'price' => 35,
            ],
            [
                'code' => 'hardware',
                'description' => 'hardware2 description',
                'price' => 35,
            ],
        ];

        foreach ($list as $item) {
            $code = $item['code'] ?? '';
            $description = $item['description'] ?? '';

            $entity = new Gift();
            $entity->setCode($code);
            $entity->setDescription($description);
            $entity->setPrice($item['price'] ?? 0);

            $manager->persist($entity);
            $manager->flush();

            self::$gift[$description] = $description;
            $this->addReference(self::$gift[$description], $entity);
        }
    }
}
