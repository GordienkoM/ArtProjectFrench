<?php

namespace App\Repository;

use App\Entity\PaitingOrder;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PaitingOrder|null find($id, $lockMode = null, $lockVersion = null)
 * @method PaitingOrder|null findOneBy(array $criteria, array $orderBy = null)
 * @method PaitingOrder[]    findAll()
 * @method PaitingOrder[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PaitingOrderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PaitingOrder::class);
    }

    // /**
    //  * @return PaitingOrder[] Returns an array of PaitingOrder objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PaitingOrder
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
