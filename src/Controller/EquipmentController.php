<?php

namespace App\Controller;

use App\Entity\Equipment;
use App\Repository\EquipmentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
     * @Route("/", name="equipment")
     */
    public function index()
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/EquipmentController.php',
        ]);
    }

    /**
     * @Route("/page/{pageNumber}", name="equipment_page")
     */
    public function getEquipmentForPage(int $pageNumber, SerializerInterface $serializer)
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
}
