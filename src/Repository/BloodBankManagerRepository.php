<?php

namespace App\Repository;

use App\Entity\BloodBankManager;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BloodBankManager|null find($id, $lockMode = null, $lockVersion = null)
 * @method BloodBankManager|null findOneBy(array $criteria, array $orderBy = null)
 * @method BloodBankManager[]    findAll()
 * @method BloodBankManager[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BloodBankManagerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BloodBankManager::class);
    }

    // /**
    //  * @return BloodBankManager[] Returns an array of BloodBankManager objects
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
    public function findOneBySomeField($value): ?BloodBankManager
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
