<?php

namespace App\Repository;

use App\Entity\Constraint;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Constraint|null find($id, $lockMode = null, $lockVersion = null)
 * @method Constraint|null findOneBy(array $criteria, array $orderBy = null)
 * @method Constraint[]    findAll()
 * @method Constraint[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConstraintRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Constraint::class);
    }

    // /**
    //  * @return Constraint[] Returns an array of Constraint objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Constraint
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
