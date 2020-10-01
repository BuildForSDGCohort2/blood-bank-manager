<?php

namespace App\Repository;

use App\Entity\BloodBank;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BloodBank|null find($id, $lockMode = null, $lockVersion = null)
 * @method BloodBank|null findOneBy(array $criteria, array $orderBy = null)
 * @method BloodBank[]    findAll()
 * @method BloodBank[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BloodBankRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BloodBank::class);
    }

    // /**
    //  * @return BloodBank[] Returns an array of BloodBank objects
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
    public function findOneBySomeField($value): ?BloodBank
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
