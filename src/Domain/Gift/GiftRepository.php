<?php

namespace App\Domain\Gift;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Gift|null find($id, $lockMode = null, $lockVersion = null)
 * @method Gift|null findOneBy(array $criteria, array $orderBy = null)
 * @method Gift[]    findAll()
 * @method Gift[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GiftRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Gift::class);
    }

    // /**
    //  * @return GiftFixtures[] Returns an array of GiftFixtures objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?GiftFixtures
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
