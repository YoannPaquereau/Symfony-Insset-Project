<?php


namespace App\Controller\accountManager;


use App\Entity\User;
use App\Form\RegisterType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class RegisterController extends AbstractController
{
    /**
     * @Route("/register", name="registerForm")
     */
    public function register(Request $request) {
        $user = new User();

        $form = $this->createForm(RegisterType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();

            $user->setPassword(password_hash($user->getPassword(), PASSWORD_DEFAULT));

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return new Response("Inscription réussie !");
        }

        return $this->render('accountManager/register.html.twig', [
            'formRegister' => $form->createView()
        ]);
    }
}