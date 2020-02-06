<?php


namespace App\Controller;


use App\Entity\Product;
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

    public function getProduct() {
        $product = $this->getDoctrine()
            ->getRepository(Product::class)
            ->findBy([
                'available' => true
            ]);

        return $this->render('products/product.html.twig', [
            'products' => $product,
            'url' => $this->getParameter('app.path.product_images')
        ]);
    }
}
