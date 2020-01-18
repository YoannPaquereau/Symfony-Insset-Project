<?php


namespace App\Controller\accountManager;


use App\Entity\User;
use App\Form\LoginType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class LoginController extends AbstractController
{

    /**
     * @Route("/login", name="loginForm")
     * @param Request $request
     * @return Response
     */
    public function login(Request $request) {
        $user = new User();

        $form = $this->createForm(LoginType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();

            $repository = $this->getDoctrine()->getRepository(User::class);

            $userFind = $repository->findOneBy(['username' => $user->getUsername()]);

            if (password_verify($user->getPassword(), $userFind->getPassword())) {
                return new Response("Connexion réussie !");
            }
        }

        return $this->render('accountManager/login.html.twig', [
            'formLogin' => $form->createView()
        ]);
    }

}