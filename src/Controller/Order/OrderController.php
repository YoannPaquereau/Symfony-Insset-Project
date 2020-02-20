<?php


namespace App\Controller\Order;

use App\Service\Basket\BasketService;
use App\Service\Order\OrderService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
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

        $error = null;
        if (!$orderService->createOrder($this->getUser())) {
            return $this->redirectToRoute("basket_index", ['error' => true]);
        }

        return $this->redirectToRoute("homepage", []);
    }

    /**
     * @Route("/shipped", name="shipped_order")
     * @param Request $request
     * @param OrderService $orderService
     * @param \Swift_Mailer $mailer
     * @return RedirectResponse
     */
    public function orderShipped(Request $request, OrderService $orderService, \Swift_Mailer $mailer) {
        $id = $request->query->get('id');

        $orderService->shippedOrder($id, $mailer);

        return $this->redirectToRoute('easyadmin', [
            'action' => 'show',
            'id' => $id,
            'entity' => $request->query->get('entity')
        ]);
    }
}
