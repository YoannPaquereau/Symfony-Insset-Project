<?php


namespace App\Controller;


use App\Service\Basket\BasketService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/basket")
 * Class ShoppingController
 * @package App\Controller
 */

class ShoppingController extends AbstractController
{

    /**
     * @Route("/", name="basket_index")
     * @param BasketService $basketService
     * @return Response
     */
    public function index(BasketService $basketService) {
        return $this->render('basket/basket.html.twig', [
            'products'=> $basketService->getBasket(),
            'url' => $this->getParameter('app.path.product_images'),
            'total' => $basketService->getTotal()
        ]);
    }

    /**
     * @Route("/add/{id}", name="addBasket")
     * @param $id
     * @param BasketService $basketService
     * @return RedirectResponse
     */
    public function addProduct($id, BasketService $basketService) {
        $basketService->add($id);
        return $this->redirectToRoute("basket_index");
    }

    /**
     * @Route("/remove/{id}", name="removeBasket")
     * @param $id
     * @param BasketService $basketService
     * @return RedirectResponse
     */
    public function removeProduct($id, BasketService $basketService) {
        $basketService->remove($id);
        return $this->redirectToRoute("basket_index");
    }
}
