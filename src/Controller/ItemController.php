<?php

namespace App\Controller;

use App\Entity\Item;
use App\Repository\ItemRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class ItemController
 * @package App\Controller
 * @Route("/item")
 */
class ItemController extends AbstractController
{
    /**
     * @Route("/", name="item_index")
     */
    public function index()
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ItemController.php',
        ]);
    }

    /**
     * @Route("/all", name="item_all")
     * @param EntityManager $manager
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function all(SerializerInterface $serializer)
    {
        $manager = $this->getDoctrine()->getManager();
        /** @var ItemRepository $itemRepository */
        $itemRepository = $manager->getRepository(Item::class);
        $items = $itemRepository->getNFirsts(10);

        return $this->json($items);
    }
}
