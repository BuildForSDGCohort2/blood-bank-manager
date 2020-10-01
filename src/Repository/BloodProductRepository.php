<?php

namespace App\Repository;

use App\Entity\BloodProduct;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BloodProduct|null find($id, $lockMode = null, $lockVersion = null)
 * @method BloodProduct|null findOneBy(array $criteria, array $orderBy = null)
 * @method BloodProduct[]    findAll()
 * @method BloodProduct[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BloodProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BloodProduct::class);
    }

    // /**
    //  * @return BloodProduct[] Returns an array of BloodProduct objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BloodProduct
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
