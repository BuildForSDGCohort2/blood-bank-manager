<?php

namespace App\Repository;

use App\Entity\BloodProductStock;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BloodProductStock|null find($id, $lockMode = null, $lockVersion = null)
 * @method BloodProductStock|null findOneBy(array $criteria, array $orderBy = null)
 * @method BloodProductStock[]    findAll()
 * @method BloodProductStock[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BloodProductStockRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BloodProductStock::class);
    }

    // /**
    //  * @return BloodProductStock[] Returns an array of BloodProductStock objects
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
    public function findOneBySomeField($value): ?BloodProductStock
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
