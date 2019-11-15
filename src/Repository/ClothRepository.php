<?php

namespace App\Repository;

use App\Entity\Cloth;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * @method Cloth|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cloth|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cloth[]    findAll()
 * @method Cloth[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClothRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cloth::class);
    }

    public function getClothsAtPage(int $page, int $equipmentsPerPage = 24)
    {
        $manager = $this->getEntityManager();
        $query = $manager->createQuery(
          'SELECT c, e from App\Entity\Cloth c
          INNER JOIN c.equipments e
          '
        );
        $query->setFirstResult($page * $equipmentsPerPage);
        $query->setMaxResults($equipmentsPerPage);
        $paginator = new Paginator($query, $fetchJoinCollection = true);

        return $paginator;
//        $queryBuilder = $this->createQueryBuilder('c');
//        $queryBuilder->select('c, e')
//            ->innerJoin('c.equipments', 'e')
//        ;
//        $queryBuilder->setFirstResult($page * $equipmentsPerPage)
//            ->setMaxResults($equipmentsPerPage);
//
//        return $queryBuilder->getQuery()->getArrayResult();
    }
}
