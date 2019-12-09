<?php

namespace App\Controller;

use App\Entity\Item;
use App\Repository\ItemRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ResourceController
 * @package App\Controller
 * @Route("/resource")
 */
class ResourceController extends AbstractController
{
    /**
     * @Route("/price", name="resource_name", methods={"POST"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function getPrice(Request $request)
    {
        $itemName = $request->request->get('name');
        /** @var ItemRepository $itemRepository */
        $itemRepository = $this->getDoctrine()->getRepository(Item::class);
        $result = $itemRepository->findResourceByName($itemName);

        $formattedResult = array_reduce($result, function ($acc, $cur) {
            $itemName = $cur['name'];
            if (!isset($acc[$itemName])) {
                $acc[$itemName] = [];
            }
            if (!isset($acc[$itemName]['date']) || $acc[$itemName]['date'] < $cur['date']) {
                $acc[$itemName] = $cur;
                if (isset($acc[$itemName]['date'])) {
                    $acc[$itemName]['date'] = $acc[$itemName]['date']->format("d-m-Y H:i:s");
                }
            }

            return $acc;
        }, []);

        return $this->json($formattedResult);
    }
}
