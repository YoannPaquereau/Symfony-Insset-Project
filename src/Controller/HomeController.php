<?php


namespace App\Controller;


use App\Entity\Product;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     * @param Request $request
     * @return Response
     */
    public function home(Request $request) {
        return $this->render('homepage.html.twig');
    }

    public function getProduct(PaginatorInterface $paginator, Request $request) {
        $product = $this->getDoctrine()
            ->getRepository(Product::class)
        ;
        $pagination = $paginator->paginate(
            $product->findBy([
                'available' => 1
            ]),
            $request->query->getInt('page', 1),
            9
        );


        return $this->render('products/product.html.twig', [
            'products' => $pagination,
            'url' => $this->getParameter('app.path.product_images')
        ]);
    }
}
