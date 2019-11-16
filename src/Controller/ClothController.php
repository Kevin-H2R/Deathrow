<?php

namespace App\Controller;

use App\Entity\Cloth;
use App\Entity\Equipment;
use App\Repository\ClothRepository;
use App\Repository\EquipmentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
     * @param int $pageNumber
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function getClothsForPage(int $pageNumber)
    {
        $manager = $this->getDoctrine()->getManager();
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

    /**
     * @Route("/name", name="cloth_name", methods={"POST"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function getClothByName(Request $request)
    {
        $name = $request->request->get('name');
        $name = htmlspecialchars($name);
        $manager = $this->getDoctrine()->getManager();
        /** @var ClothRepository $repository */
        $repository = $manager->getRepository(Cloth::class);
        $clothPaginator = $repository->filterByName($name);
        $json = [];
        /** @var Cloth $cloth */
        foreach ($clothPaginator as $cloth) {
            $json[] = $cloth->toJson(2);
        }

        return $this->json($json);
    }
}
