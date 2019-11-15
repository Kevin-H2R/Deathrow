<?php

namespace App\Controller;

use App\Entity\Equipment;
use App\Repository\EquipmentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class EquipmentController
 * @package App\Controller
 * @Route("/equipment")
 */
class EquipmentController extends AbstractController
{
    /**
     * @Route("/page/{pageNumber}", name="equipment_page")
     * @param int $pageNumber
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function getEquipmentForPage(int $pageNumber)
    {
        $manager = $this->getDoctrine()->getManager();
        /** @var EquipmentRepository $equipmentRespository */
        $equipmentRespository = $manager->getRepository(Equipment::class);
        $equipmentsPaginator = $equipmentRespository->getEquipmentsAtPage($pageNumber);
        $json = [];
        /** @var Equipment $equipment */
        foreach ($equipmentsPaginator as $equipment) {
            $json[] = $equipment->toJson();
        }

        return $this->json($json);
    }

    /**
     * @Route("/name", name="equipment_name", methods={"POST"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function getEquipmentByName(Request $request)
    {
        $name = $request->request->get('name');

        $manager = $this->getDoctrine()->getManager();
        /** @var EquipmentRepository $equipmentRespository */
        $equipmentRespository = $manager->getRepository(Equipment::class);
        $equipments = $equipmentRespository->filterByName($name);

        $json = [];
        /** @var Equipment $equipment */
        foreach ($equipments as $equipment) {
            $json[] = $equipment->toJson();
        }

        return $this->json($json);
    }
}
