<?php

namespace App\Repository;

use App\Entity\Equipment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\Expr\Join;

/**
 * @method Equipment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Equipment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Equipment[]    findAll()
 * @method Equipment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EquipmentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Equipment::class);
    }

    public function getEquipmentsAtPage(int $page, int $equipmentsPerPage = 10)
    {
        $queryBuilder = $this->createQueryBuilder('e');
        $queryBuilder->select('e, c', 'ef', 'r', 'i')
            ->innerJoin('e.cloth', 'c')
            ->innerJoin('e.effects', 'ef')
            ->innerJoin('e.recipes', 'r')
            ->innerJoin('r.item', 'i')
            ;
        $query = $queryBuilder->getQuery();
        $results = $query->setFirstResult($page * $equipmentsPerPage)
            ->setMaxResults($equipmentsPerPage)->getArrayResult();

        return $results;
    }

    // /**
    //  * @return Equipment[] Returns an array of Equipment objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Equipment
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
