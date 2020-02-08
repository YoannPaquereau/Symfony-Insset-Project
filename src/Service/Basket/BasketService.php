<?php


namespace App\Service\Basket;


use Symfony\Component\HttpFoundation\Session\SessionInterface;

class BasketService
{
    protected $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function add(int $id) {
        $basket = $this->session->get('basket', []);

        if (!empty($basket[$id])) {
            $basket[$id]++;
        }
        else {
            $basket[$id] = 1;
        }

        $this->session->set('basket', $basket);
    }
}
