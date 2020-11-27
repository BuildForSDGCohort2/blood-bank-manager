<?php

namespace App\Repository;

use App\Entity\BloodProductStock;
use App\Entity\BloodProductStockSearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
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

    public function findByQuery(BloodProductStockSearch $search)
    {
        // bps = bloodProductStock
        $qb = $this->createQueryBuilder('bps');
        $expr = $qb->expr();

        $query = $qb->leftJoin('bps.product', 'bp')
            ->addSelect('bp')
            ->leftJoin('bp.type', 'bpt')
            ->addSelect('bpt')
            ->leftJoin('bp.bloodGroup', 'bpg')
            ->addSelect('bpg')
            ->leftJoin('bps.bloodBank', 'bb')
            ->addSelect('bb')

            ->andWhere(
                $expr->eq('bb.indexed', ':bb_indexed')
            )
            ->setParameter(':bb_indexed', true)
            ->andWhere(
                $expr->gt('bps.expireAt', ':now')
            )
            ->setParameter(':now', $search->getDatetime())
            ->andWhere(
                $expr->eq('bpt.id', ':bp_type_id')
            )
            ->setParameter(':bp_type_id', $search->getTypeId())
            ->andWhere(
                $expr->orX('bpg.id = :bp_bloodGroup', 'bpg.code = :bp_bloodGroup')
            )
            ->setParameter(':bp_bloodGroup', $search->getBloodGroup())
            ->andWhere(
                $expr->eq('bp.volume', ':bp_volume')
            )
            ->setParameter(':bp_volume', $search->getVolume())
            ->andWhere(
                $expr->gte('bps.quantity', ':quantity')
            )
            ->setParameter(':quantity', $search->getQuantity())
            ->getQuery();

        $results = $query->getArrayResult();

        $response['status'] = 'success';
        $response['datas'] = [];

        foreach ($results as $key => $result) {
            if (!in_array($result['bloodBank'], $response['datas'])) {
                $response['datas'][] = $result['bloodBank'];
            }
        }

        return $response;
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
