<?php


namespace App\Controller;


use App\Service\Basket\BasketService;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @param BasketService $basketService
     * @return Response
     */
    public function home(PaginatorInterface $paginator, Request $request, BasketService $basketService)  {
        $confirmOrder = ($basketService->getConfirmOrder()) ? true : false;
        $em = $this->getDoctrine()->getManager();

        $dql = "SELECT p FROM App\Entity\Product p WHERE p.available = 1";
        $query = $em->createQuery($dql);

        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            12
        );

        return $this->render('homepage.html.twig', [
            'products' => $pagination,
            'url' => $this->getParameter('app.path.product_images'),
            'orderConfirm' => $confirmOrder
        ]);
    }
}
