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
            $json[] = $equipment->toJson(1);
        }

        return $this->json($json);
    }

    /**
     * @Route("/weapons/page/{pageNumber}", name="weapon_page")
     * @param int $pageNumber
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function getWeaponForPage(int $pageNumber)
    {
        $manager = $this->getDoctrine()->getManager();
        /** @var EquipmentRepository $equipmentRespository */
        $equipmentRespository = $manager->getRepository(Equipment::class);
        $equipmentsPaginator = $equipmentRespository->getWeaponsAtPage($pageNumber);
        $json = [];
        /** @var Equipment $equipment */
        foreach ($equipmentsPaginator as $equipment) {
            $json[] = $equipment->toJson(1);
        }

        return $this->json($json);
    }

    /**
     * @Route("/weapons/name", name="weapons_name", methods={"POST"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function getWeaponsByName(Request $request)
    {
        $name = $request->request->get('name');
        $name = htmlspecialchars($name);
        $manager = $this->getDoctrine()->getManager();
        /** @var EquipmentRepository $equipmentRepository */
        $equipmentRepository = $manager->getRepository(Equipment::class);
        $equipments = $equipmentRepository->filterWeaponsByName($name);

        $json = [];
        /** @var Equipment $equipment */
        foreach ($equipments as $equipment) {
            $json[] = $equipment->toJson(1);
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
        $name = htmlspecialchars($name);
        $manager = $this->getDoctrine()->getManager();
        /** @var EquipmentRepository $equipmentRepository */
        $equipmentRepository = $manager->getRepository(Equipment::class);
        $equipments = $equipmentRepository->filterByName($name);

        $json = [];
        /** @var Equipment $equipment */
        foreach ($equipments as $equipment) {
            $json[] = $equipment->toJson(1);
        }

        return $this->json($json);
    }

    /**
     * @Route("/types", name="equipment_types", methods={"POST"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function getEquipmentsByType(Request $request)
    {
        $types = $request->request->get('types');
        $manager = $this->getDoctrine()->getManager();
        /** @var EquipmentRepository $equipmentRepository */
        $equipmentRepository = $manager->getRepository(Equipment::class);
        $equipments = $equipmentRepository->getEquipmentsByTypeAtPage($types, 0);

        $json = [];
        /** @var Equipment $equipment */
        foreach ($equipments as $equipment) {
            $json[] = $equipment->toJson();
        }
        return $this->json($json);
    }

    /**
     * @Route("/price", name="equipment_price", methods={"POST"})
     */
    public function getEquipmentPrice(Request $request)
    {
        $itemName = $request->request->get('name');
        /** @var EquipmentRepository $equipmentRepository */
        $equipmentRepository = $this->getDoctrine()->getRepository(Equipment::class);
        $result = $equipmentRepository->getPrices($itemName);

        $formattedResult = array_reduce($result, function ($accumulated, $current) {
            $equipmentName = $current['equipment'];
            if (!isset($accumulated[$equipmentName])) {
                $accumulated[$equipmentName] = [];
            }
            unset($current['equipment']);
            $itemName = $current['name'];
            if (!isset($accumulated[$equipmentName][$itemName])) {
                $accumulated[$equipmentName][$itemName] = [];
            }
            unset($current['name']);
            if (!isset($accumulated[$equipmentName][$itemName]['date']) || $accumulated[$equipmentName][$itemName]['date'] < $current['date']) {
                $accumulated[$equipmentName][$itemName] = $current;
                if (isset($accumulated[$equipmentName][$itemName]['date'])) {
                    $accumulated[$equipmentName][$itemName]['date'] = $accumulated[$equipmentName][$itemName]['date']->format("d-m-Y H:i:s");
                }
            }
            return $accumulated;
        }, []);

        return $this->json($formattedResult);
    }
}
