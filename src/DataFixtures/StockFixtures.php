<?php

namespace App\DataFixtures;

use App\Domain\Stock\Stock;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class StockFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $list = [
            [
                'gift' => 'animal description',
                'quantity' => 100,
            ],
            [
                'gift' => 'car description',
                'quantity' => 200,
            ],
            [
                'gift' => 'garden description',
                'quantity' => 50,
            ],
            [
                'gift' => 'sport description',
                'quantity' => 100,
            ],
            [
                'gift' => 'grocery description',
                'quantity' => 300,
            ],
            [
                'gift' => 'hardware description',
                'quantity' => 220,
            ],
            [
                'gift' => 'hardware2 description',
                'quantity' => 900,
            ],
        ];

        foreach ($list as $item) {
            $giftItem = $item['gift'] ?? '';

            $entity = new Stock();
            $entity->setGift($this->getReference(GiftFixtures::$gift[$giftItem]));
            $entity->setQuantity($item['quantity'] ?? 0);

            $manager->persist($entity);
            $manager->flush();
        }
    }

    public function getDependencies(): array
    {
        return [
            GiftFixtures::class,
        ];
    }
}
