<?php


namespace App\Service\Basket;


use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class BasketService
{
    protected $session;
    protected $productRepository;

    public function __construct(SessionInterface $session, ProductRepository $productRepository)
    {
        $this->session = $session;
        $this->productRepository = $productRepository;
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

    public function getBasket() :array {
        $basket = $this->session->get('basket', []);

        $allProduct = [];

        foreach ($basket as $id => $quantity) {
            $allProduct[] = [
                'product' => $this->productRepository->find($id),
                'quantity' => $quantity
            ];
        }

        return $allProduct;
    }

    public function getTotal(): float {

        $total = 0;

        foreach ($this->getBasket() as $item) {
            $total += $item['product']->getPrice() * $item['quantity'];
        }

        return $total;
    }

    public function remove(int $id) {
        $basket = $this->session->get('basket', []);

        if (!empty($basket[$id])) {
            unset($basket[$id]);
        }

        $this->session->set('basket', $basket);
    }

    public function editQuantity($id, $quantity) {
        $basket = $this->session->get('basket', []);
        if (!empty($basket[$id])) {
            $basket[$id] = $quantity;
        }

        $this->session->set('basket', $basket);
    }

    public function isEmpty() {
        $basket = $this->session->get("basket");
        if ($basket !== null) {
            if (!empty($basket)) {
                return true;
            }
        }
        return false;
    }

    public function empty() {
        $this->session->remove('basket');
    }

    public function setConfirmOrder() {
        $this->session->set('confirmOrder', true);
    }

    public function getConfirmOrder() {
        if ($this->session->has('confirmOrder')) {
            $this->session->remove('confirmOrder');
            return true;
        }
        return false;
    }

    public function setErrorOrder() {
        $this->session->set('errorOrder', true);
    }

    public function getErrorOrder() {
        if ($this->session->has('errorOrder')) {
            $this->session->remove('errorOrder');
            return true;
        }
        return false;
    }

    public function updateStock() {
        $basket = $this->session->get("basket", []);

        foreach ($basket as $id => &$quantity) {
            $realStock = $this->productRepository->find($id)->getStock();
            if ($realStock < $quantity) {
                if ($realStock <= 0) {
                    unset($basket[$id]);
                }
                else {
                    $quantity = $realStock;
                }
                $this->session->set('modifyStock', true);
            }
        }
        $this->session->set('basket', $basket);
    }

    public function getupdateStock() {
        if ($this->session->has('modifyStock')) {
            $this->session->remove('modifyStock');
            return true;
        }
        return false;
    }
}
