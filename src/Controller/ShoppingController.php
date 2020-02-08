<?php


namespace App\Controller;


use App\Service\Basket\BasketService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/basket")
 * Class ShoppingController
 * @package App\Controller
 */

class ShoppingController extends AbstractController
{

    /**
     * @Route("/add/{id}", name="addBasket")
     * @param $id
     * @param BasketService $basketService
     * @return RedirectResponse
     */
    public function addProduct($id, BasketService $basketService) {
        $basketService->add($id);
        return $this->redirectToRoute("homepage");
    }
}
