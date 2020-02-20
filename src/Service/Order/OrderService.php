<?php


namespace App\Service\Order;

use App\Entity\Order;
use App\Entity\OrderDetail;
use App\Entity\Product;
use App\Entity\User;
use App\Service\Basket\BasketService;
use Doctrine\ORM\EntityManagerInterface;

class OrderService
{
    protected $em;
    protected $basketService;
    protected $user;
    protected $templating;

    public function __construct(EntityManagerInterface $em, BasketService $basketService, \Twig\Environment $templating)
    {
        $this->em = $em;
        $this->basketService = $basketService;
        $this->templating = $templating;
    }
    public function createOrder($userId) {

        $user = $this->em->getRepository(User::class)->find($userId);
        $order = new Order();

        $order->setIdUser($user);
        $order->setPrice($this->basketService->getTotal());

        $this->em->persist($order);

        return $this->createOrderDetail($order);
    }

    public function createOrderDetail($order) {
        foreach($this->basketService->getBasket() as $item) {
            if ($this->em->getRepository(Product::class)->find($item['product'])->getStock() < $item['quantity']) {
                $this->basketService->setErrorOrder();
                return false;
            }
            $orderDetail = new OrderDetail();
            $orderDetail->setIdProduct($item['product']);
            $orderDetail->setQuantity($item['quantity']);
            $orderDetail->setIdOrder($order);

            $this->em->persist($orderDetail);
        }

        $this->em->flush();
        $this->basketService->empty();
        $this->basketService->setConfirmOrder();
        return true;
    }

    public function shippedOrder($id, \Swift_Mailer $mailer) {
        $repository = $this->em->getRepository(Order::class);

        $entity = $repository->find($id);
        $entity->setShippingStatus(true);
        $this->em->flush();
        $this->sendMail($entity, $mailer);
    }

    public function sendMail(Order $entity, \Swift_Mailer $mailer) {
        $user = $entity->getIdUser();
        $message = (new \Swift_Message('Avis d\'expédition de votre commande'))
            ->setFrom([$_ENV['MAILER_EMAIL'] => 'Yoann Paquereau'])
            ->setTo($user->getEmail())
            ->setBody(
                $this->templating->render('order/mail.txt.twig', [
                    'first_name' => $user->getFirstName(),
                    'last_name' => $user->getLastName()
                ]),
                'text/plain'
            )
        ;


        $mailer->send($message);
    }
}
