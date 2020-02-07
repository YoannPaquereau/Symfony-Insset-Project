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
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    public function home(PaginatorInterface $paginator, Request $request) {
        $em = $this->getDoctrine()->getManager();

        $dql = "SELECT p FROM App\Entity\Product p";
        $query = $em->createQuery($dql);

        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            9
        );

        return $this->render('homepage.html.twig', [
            'products' => $pagination,
            'url' => $this->getParameter('app.path.product_images')
        ]);
    }
}
