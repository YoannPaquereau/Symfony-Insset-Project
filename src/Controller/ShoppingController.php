<?php


namespace App\Controller;


use App\Service\Basket\BasketService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
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
     * @param Request $request
     * @return Response
     */
    public function index(BasketService $basketService, Request $request) {
        $basketService->updateStock();
        return $this->render('basket/basket.html.twig', [
            'products'=> $basketService->getBasket(),
            'url' => $this->getParameter('app.path.product_images'),
            'total' => $basketService->getTotal(),
            'last_page' => $request->headers->get('referer'),
            'error' => $basketService->getErrorOrder(),
            'updateStock' => $basketService->getupdateStock()
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

    /**
     * @Route("/edit/{id}", name="edit_quantity")
     * @param $id
     * @param BasketService $basketService
     * @return RedirectResponse
     */
    public function editQuantity($id, BasketService $basketService) {
        $quantity = $_POST['quantity'];
        $basketService->editQuantity($id, $quantity);

        return $this->redirectToRoute("basket_index");
    }

    /**
     * @Route("/change_quantity1", name="change_quantity1")
     * @param Request $request
     * @param BasketService $basketService
     * @return JsonResponse
     */
    public function change_quantity1(Request $request, BasketService $basketService) {
        $quantity = $request->request->get('quantity');
        $idProduct = $request->request->get('idProduct');

        $basketService->editQuantity($idProduct, $quantity);

        $data = ['quantity' => $quantity, 'idProduct' => $idProduct];

        return $this->json($data);
    }
}
