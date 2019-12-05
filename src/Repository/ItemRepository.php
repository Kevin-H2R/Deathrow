<?php

namespace App\Repository;

use App\Entity\Item;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Item|null find($id, $lockMode = null, $lockVersion = null)
 * @method Item|null findOneBy(array $criteria, array $orderBy = null)
 * @method Item[]    findAll()
 * @method Item[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Item::class);
    }

    public function getNFirsts($number)
    {
        $queryBuilder = $this->createQueryBuilder('i');
        $queryBuilder->setMaxResults($number);
        $query = $queryBuilder->getQuery();

        return $query->setMaxResults(10)->setFirstResult(9)->getArrayResult();
    }

    public function findByName(string $name)
    {
        return $this->createQueryBuilder('i')
            ->select('i.name')
            ->addSelect('p.unit, p.tens, p.hundreds, p.date')
            ->leftJoin('i.prices', 'p')
            ->where('i.name LIKE :val')
            ->setParameter('val', '%' . $name . '%')
            ->getQuery()
            ->getArrayResult();
    }
}
