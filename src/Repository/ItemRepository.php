<?php

namespace App\Repository;

use App\Entity\Item;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;

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

//    public function getEquipmentsAtPage(int $page, int $equipmentsPerPage = 24)
//    {
//        $manager = $this->getEntityManager();
//        $query = $manager->createQuery(
//            'SELECT e from App\Entity\Equipment e
//            INNER JOIN e.cloth c
//            INNER JOIN e.effects ef
//            INNER JOIN e.recipes r
//            INNER JOIN r.item i
//            WHERE e.type NOT IN (\'ep\', \'da\', \'ba\', \'bn\', \'ar\', \'br\', \'fx\', \'ha\', \'ma\', \'pe\', \'pi\')
//            ORDER BY e.level DESC'
//        );
//        $query->setFirstResult($page * $equipmentsPerPage);
//        $query->setMaxResults($equipmentsPerPage);
//        $paginator = new Paginator($query, $fetchJoinCollection = true);
//
//        return $paginator;
//    }
//
//    public function getWeaponsAtPage(int $page, int $equipmentsPerPage = 24)
//    {
//        $manager = $this->getEntityManager();
//        $query = $manager->createQuery(
//            "SELECT e from App\Entity\Equipment e
//            LEFT JOIN e.cloth c
//            INNER JOIN e.effects ef
//            INNER JOIN e.recipes r
//            INNER JOIN r.item i
//            WHERE e.type IN ('ep', 'da', 'ba', 'bn', 'ar', 'br', 'fx', 'ha', 'ma', 'pe', 'pi')
//            ORDER BY e.level DESC"
//        );
//        $query->setFirstResult($page * $equipmentsPerPage);
//        $query->setMaxResults($equipmentsPerPage);
//        $paginator = new Paginator($query, $fetchJoinCollection = true);
//
//        return $paginator;
//    }
//
//    public function filterByName($name)
//    {
//        $manager = $this->getEntityManager();
//        $query = $manager->createQuery(
//            "SELECT e from App\Entity\Equipment e
//            INNER JOIN e.cloth c
//            INNER JOIN e.effects ef
//            INNER JOIN e.recipes r
//            INNER JOIN r.item i
//            WHERE e.name LIKE '%$name%' AND
//            e.type NOT IN ('ep', 'da', 'ba', 'bn', 'ar', 'br', 'fx', 'ha', 'ma', 'pe', 'pi')
//            ORDER BY e.level DESC"
//        );
//
//        return $query->getResult();
//    }
//    public function filterWeaponsByName($name)
//    {
//        $manager = $this->getEntityManager();
//        $query = $manager->createQuery(
//            "SELECT e from App\Entity\Equipment e
//            LEFT JOIN e.cloth c
//            INNER JOIN e.effects ef
//            INNER JOIN e.recipes r
//            INNER JOIN r.item i
//            WHERE e.name LIKE '%$name%' AND
//            e.type IN ('ep', 'da', 'ba', 'bn', 'ar', 'br', 'fx', 'ha', 'ma', 'pe', 'pi')
//            ORDER BY e.level DESC"
//        );
//
//        return $query->getResult();
//    }
//
//    public function getClothsAtPage(int $page, int $equipmentsPerPage = 24)
//    {
//        $queryBuilder = $this->createQueryBuilder('e');
//        $queryBuilder->select('c.id clothId, c.name clothName, c.level, e.id ,e.type, e.name')
//            ->innerJoin('e.cloth', 'c')
//            ->setFirstResult($page * $equipmentsPerPage)
//            ->setMaxResults($equipmentsPerPage)
//        ;
//
//        return $queryBuilder->getQuery()->getArrayResult();
//    }
//
//    public function getEquipmentsByTypeAtPage(
//        array $types,
//        int $page,
//        int $equipmentsPerPage = 24
//    ) {
//        $formattedTypes = "'". implode("','", $types) . "'";
//        $manager = $this->getEntityManager();
//        $query = $manager->createQuery(
//            "SELECT e from App\Entity\Equipment e
//            LEFT JOIN e.cloth c
//            INNER JOIN e.effects ef
//            INNER JOIN e.recipes r
//            INNER JOIN r.item i
//            WHERE e.type in ($formattedTypes)
//            ORDER BY e.level DESC"
//        );
//        $query->setFirstResult($page * $equipmentsPerPage);
//        $query->setMaxResults($equipmentsPerPage);
//        $paginator = new Paginator($query, $fetchJoinCollection = true);
//
//        return $paginator;
//    }
//
//    public function getPrices($itemName = "Bouf")
//    {
//        return $this->createQueryBuilder('e')
//            ->select('e.name as equipment, i.name, r.count, p.unit, p.tens, p.hundreds, p.date')
//            ->innerJoin('e.recipes', 'r')
//            ->innerJoin('r.item', 'i')
//            ->leftJoin('i.prices', 'p')
//            ->where('e.name LIKE :val')
//            ->orderBy('r.count', 'DESC')
//            ->setParameter('val', "%".$itemName."%")
//            ->getQuery()
//            ->getArrayResult();
//    }
}
