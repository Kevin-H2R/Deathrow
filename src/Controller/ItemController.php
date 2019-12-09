<?php

namespace App\Controller;

use App\Entity\Item;
use App\Repository\ItemRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @Route("/price", name="item_name", methods={"POST"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function getPrice(Request $request)
    {
        $itemName = $request->request->get('name');
        /** @var ItemRepository $itemRepository */
        $itemRepository = $this->getDoctrine()->getRepository(Item::class);
        $result = $itemRepository->findItemByName($itemName);

        $formattedResult = array_reduce($result, function ($acc, $cur) {
            $itemName = $cur['name'];
            if (!isset($acc[$itemName])) {
                $acc[$itemName] = [];
            }

            $resource = $cur['resource'];
            if (!isset($acc[$itemName][$resource])) {
                $acc[$itemName][$resource] = [];
            }
            if (empty($acc[$itemName][$resource]) || $acc[$itemName][$resource]['date'] < $cur['date']) {
                unset($cur['name']);
                unset($cur['resource']);
                if (isset($cur['date'])) {
                    $cur['date'] = $cur['date']->format("d-m-Y H:i:s");
                }
                $acc[$itemName][$resource] = $cur;
            }
            return $acc;
        });

//        $formattedResult = array_reduce($result, function ($acc, $cur) {
//            $itemName = $cur['name'];
//            if (!isset($acc[$itemName])) {
//                $acc[$itemName] = [];
//            }
//            if (!isset($acc[$itemName]['date']) || $acc[$itemName]['date'] < $cur['date']) {
//                $acc[$itemName] = $cur;
//                if (isset($acc[$itemName]['date'])) {
//                    $acc[$itemName]['date'] = $acc[$itemName]['date']->format("d-m-Y H:i:s");
//                }
//            }
//
//            return $acc;
//        }, []);

        return $this->json($formattedResult);
    }
}
