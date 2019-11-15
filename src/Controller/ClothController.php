<?php

namespace App\Controller;

use App\Entity\Cloth;
use App\Entity\Equipment;
use App\Repository\ClothRepository;
use App\Repository\EquipmentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class ClothController
 * @package App\Controller
 * @Route("/cloth")
 */
class ClothController extends AbstractController
{
    /**
     * @Route("/page/{pageNumber}")
     */
    public function getClothsForPage(int $pageNumber)
    {
        $manager = $this->getDoctrine()->getManager();
//        /** @var EquipmentRepository $equipmentRespository */
//        $equipmentRespository = $manager->getRepository(Equipment::class);
//        $equipmentsPaginator = $equipmentRespository->getClothsAtPage($pageNumber);
        /** @var ClothRepository $clothRepository */
        $clothRepository = $manager->getRepository(Cloth::class);
        $clothPaginator = $clothRepository->getClothsAtPage($pageNumber);
        $json = [];
        /** @var Cloth $cloth */
        foreach ($clothPaginator as $cloth) {
            $json[] = $cloth->toJson(1);
        }
        return $this->json($json);
//        return $this->json($equipmentsPaginator);
    }
}
