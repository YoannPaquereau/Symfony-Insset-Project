<?php


namespace App\Controller;

use App\Service\Order\OrderService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/account")
 * Class AccountController
 * @package App\Controller
 */

class AccountController extends AbstractController
{
    /**
     * @Route("/infos", name="account_infos")
     */
    public function index() {
        return $this->render('account/infos.html.twig');
    }

    /**
     * @Route("/orders", name="account_orders")
     * @return Response
     */
    public function orders() {
        return $this->render('account/orders.html.twig', [
            'orders' => $this->getUser()->getOrders(),
        ]);
    }

    /**
     * @Route("/orders/{id}", name="account_order_details")
     * @param $id
     * @param OrderService $orderService
     * @return Response
     */
    public function orderDetails($id, OrderService $orderService) {
        return $this->render('account/details_order.html.twig', [
            'order' => $orderService->getOrder($id),
            'url' => $this->getParameter('app.path.product_images')
        ]);
    }

}