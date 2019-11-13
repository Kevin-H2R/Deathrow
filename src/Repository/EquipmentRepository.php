<?php

namespace App\Repository;

use App\Entity\Equipment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Component\Serializer\SerializerInterface;

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

    public function getEquipmentsAtPage(int $page, int $equipmentsPerPage = 24)
    {
        $manager = $this->getEntityManager();
        $query = $manager->createQuery(
            'SELECT e from App\Entity\Equipment e
            INNER JOIN e.cloth c
            INNER JOIN e.effects ef
            INNER JOIN e.recipes r
            INNER JOIN r.item i
            ORDER BY e.level DESC'
        );
        $query->setFirstResult($page * $equipmentsPerPage);
        $query->setMaxResults($equipmentsPerPage);
        $paginator = new Paginator($query, $fetchJoinCollection = true);

        return $paginator;
    }

    public function filterByName($name)
    {
        $manager = $this->getEntityManager();
        $query = $manager->createQuery(
            "SELECT e from App\Entity\Equipment e
            INNER JOIN e.cloth c
            INNER JOIN e.effects ef
            INNER JOIN e.recipes r
            INNER JOIN r.item i
            WHERE e.name LIKE '%$name%'
            ORDER BY e.level DESC"
        );

        return $query->getResult();
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
