<?php


namespace App\Service\Order;

use App\Entity\Order;
use App\Entity\OrderDetail;
use App\Entity\User;
use App\Service\Basket\BasketService;
use Doctrine\ORM\EntityManagerInterface;

class OrderService
{
    protected $em;
    protected $basketService;
    protected $user;

    public function __construct(EntityManagerInterface $em, BasketService $basketService)
    {
        $this->em = $em;
        $this->basketService = $basketService;
    }
    public function createOrder($userId) {

        $user = $this->em->getRepository(User::class)->find($userId);
        $order = new Order();

        $order->setIdUser($user);
        $order->setPrice($this->basketService->getTotal());

        $this->em->persist($order);
        $this->em->flush();

        $this->createOrderDetail($order);
    }

    public function createOrderDetail($order) {
        foreach($this->basketService->getBasket() as $item) {
            $orderDetail = new OrderDetail();
            $orderDetail->setIdProduct($item['product']);
            $orderDetail->setQuantity($item['quantity']);
            $orderDetail->setIdOrder($order);

            $this->em->persist($orderDetail);
        }

        $this->em->flush();
    }
}
