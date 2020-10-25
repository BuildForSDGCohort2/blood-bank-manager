<?php

namespace App\Repository;

use App\Entity\BloodProductOrder;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BloodProductOrder|null find($id, $lockMode = null, $lockVersion = null)
 * @method BloodProductOrder|null findOneBy(array $criteria, array $orderBy = null)
 * @method BloodProductOrder[]    findAll()
 * @method BloodProductOrder[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BloodProductOrderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BloodProductOrder::class);
    }

    // /**
    //  * @return BloodProductOrder[] Returns an array of BloodProductOrder objects
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
    public function findOneBySomeField($value): ?BloodProductOrder
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
