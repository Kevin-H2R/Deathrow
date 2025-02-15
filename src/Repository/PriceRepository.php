<?php

namespace App\Repository;

use App\Entity\Price;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Price|null find($id, $lockMode = null, $lockVersion = null)
 * @method Price|null findOneBy(array $criteria, array $orderBy = null)
 * @method Price[]    findAll()
 * @method Price[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PriceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Price::class);
    }

    public function getPricesForItem(string $itemName)
    {
        $queryBuilder = $this->createQueryBuilder('p')
            ->select('e.name as equipment, p.unit, p.tens, p.hundreds, p.date')
            ->addSelect('i.name')
            ->addSelect('r.count')
            ->innerJoin('p.item', 'i')
            ->innerJoin('i.equipments', 'e')
            ->innerJoin('e.recipes', 'r', 'WITh', 'r.item = i')
            ->andWhere('e.name LIKE :val')
            ->setParameter('val', "%".$itemName."%");

        return $queryBuilder->getQuery()->getArrayResult();
    }

    // /**
    //  * @return Price[] Returns an array of Price objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Price
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
