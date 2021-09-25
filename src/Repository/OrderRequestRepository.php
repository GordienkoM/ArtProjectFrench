<?php

namespace App\Repository;

use App\Entity\OrderRequest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method OrderRequest|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderRequest|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderRequest[]    findAll()
 * @method OrderRequest[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderRequestRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrderRequest::class);
    }

    // /**
    //  * @return OrderRequest[] Returns an array of OrderRequest objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?OrderRequest
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
