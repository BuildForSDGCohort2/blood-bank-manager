<?php

namespace App\Repository;

use App\Entity\BloodProductType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BloodProductType|null find($id, $lockMode = null, $lockVersion = null)
 * @method BloodProductType|null findOneBy(array $criteria, array $orderBy = null)
 * @method BloodProductType[]    findAll()
 * @method BloodProductType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BloodProductTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BloodProductType::class);
    }

    // /**
    //  * @return BloodProductType[] Returns an array of BloodProductType objects
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
    public function findOneBySomeField($value): ?BloodProductType
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
