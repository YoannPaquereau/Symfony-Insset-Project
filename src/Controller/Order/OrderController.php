<?php


namespace App\Controller\Order;

use App\Service\Basket\BasketService;
use App\Service\Order\OrderService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/order")
 * Class OrderController
 * @package App\Controller\Order
 */

class OrderController extends AbstractController
{
    /**
     * @Route("/create", name="order_create")
     * @param OrderService $orderService
     * @param BasketService $basketService
     * @return RedirectResponse
     */
    public function orderDetail(OrderService $orderService, BasketService $basketService) {
        if (!$basketService->isEmpty()) {
            return $this->redirectToRoute('basket_index');
        }

        $orderService->createOrder($this->getUser());
        return $this->redirectToRoute("homepage");
    }
}
