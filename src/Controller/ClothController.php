<?php

namespace App\Controller;

use App\Entity\Equipment;
use App\Repository\EquipmentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

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
        /** @var EquipmentRepository $equipmentRespository */
        $equipmentRespository = $manager->getRepository(Equipment::class);
        $equipmentsPaginator = $equipmentRespository->getClothsAtPage($pageNumber);
        return $this->json($equipmentsPaginator);
//        $json = [];
//        /** @var Equipment $equipment */
//        foreach ($equipmentsPaginator as $equipment) {
//            $json[] = $equipment->toJson();
//        }
//
//        return $this->json($json);
    }
}
