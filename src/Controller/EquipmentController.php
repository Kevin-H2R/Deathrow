<?php

namespace App\Controller;

use App\Entity\Equipment;
use App\Repository\EquipmentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

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
     * @Route("/page/{pageNumber}")
     */
    public function getEquipmentForPage(int $pageNumber)
    {
        $manager = $this->getDoctrine()->getManager();
        /** @var EquipmentRepository $equipmentRespository */
        $equipmentRespository = $manager->getRepository(Equipment::class);
        $equipments = $equipmentRespository->getEquipmentsAtPage($pageNumber);

        return $this->json($equipments);
    }
}
