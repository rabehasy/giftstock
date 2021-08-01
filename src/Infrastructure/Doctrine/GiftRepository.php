<?php

namespace App\Infrastructure\Doctrine;

use App\Domain\Gift\Gift;
use App\Domain\Gift\GiftRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class GiftRepository extends ServiceEntityRepository implements GiftRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Gift::class);
    }

    public function save(Gift $gift): void
    {
        $this->_em->persist($gift);
        $this->_em->flush();
    }
}
