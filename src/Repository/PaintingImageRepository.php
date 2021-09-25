<?php

namespace App\Repository;

use App\Entity\PaintingImage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PaintingImage|null find($id, $lockMode = null, $lockVersion = null)
 * @method PaintingImage|null findOneBy(array $criteria, array $orderBy = null)
 * @method PaintingImage[]    findAll()
 * @method PaintingImage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PaintingImageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PaintingImage::class);
    }

    /**
     * @return PaintingImage[] Returns an array of Painting objects
     */
    
    public function findAvailablePaintingImages()
    {
        $entityManager = $this->getEntityManager();

        $q = $entityManager->createQuery(
            'SELECT i
            FROM App\Entity\PaintingImage i
            LEFT JOIN App\Entity\Painting p
            WITH p = i.painting
            WHERE p IS NULL'
        );

        return $q->execute();
    }


    
    // /**
    //  * @return PaintingImage[] Returns an array of PaintingImage objects
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
    public function findOneBySomeField($value): ?PaintingImage
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
