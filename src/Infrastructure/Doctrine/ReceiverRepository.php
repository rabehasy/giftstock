<?php

namespace App\Infrastructure\Doctrine;

use App\Domain\Receiver\Receiver;
use App\Domain\Receiver\ReceiverRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ReceiverRepository extends ServiceEntityRepository implements ReceiverRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Receiver::class);
    }

    public function save(Receiver $receiver): void
    {
        $this->_em->persist($receiver);
        $this->_em->flush();
    }
}
