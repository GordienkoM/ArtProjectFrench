<?php

namespace App\Repository;

use App\Entity\GeneralRequest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method GeneralRequest|null find($id, $lockMode = null, $lockVersion = null)
 * @method GeneralRequest|null findOneBy(array $criteria, array $orderBy = null)
 * @method GeneralRequest[]    findAll()
 * @method GeneralRequest[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GeneralRequestRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GeneralRequest::class);
    }

    // /**
    //  * @return GeneralRequest[] Returns an array of GeneralRequest objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?GeneralRequest
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
