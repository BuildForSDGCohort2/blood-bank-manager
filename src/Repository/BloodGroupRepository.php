<?php

namespace App\Repository;

use App\Entity\BloodGroup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BloodGroup|null find($id, $lockMode = null, $lockVersion = null)
 * @method BloodGroup|null findOneBy(array $criteria, array $orderBy = null)
 * @method BloodGroup[]    findAll()
 * @method BloodGroup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BloodGroupRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BloodGroup::class);
    }

    // /**
    //  * @return BloodGroup[] Returns an array of BloodGroup objects
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
    public function findOneBySomeField($value): ?BloodGroup
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
