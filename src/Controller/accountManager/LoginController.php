<?php


namespace App\Controller\accountManager;


use App\Entity\User;
use App\Form\LoginType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;


class LoginController extends AbstractController
{
    private $session;

    public function __construct(SessionInterface $session) {
        $this->session = $session;
    }

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
                $this->session->set('user', serialize($user));
                return $this->redirectToRoute('homepage');
            }
        }

        return $this->render('accountManager/login.html.twig', [
            'formLogin' => $form->createView()
        ]);
    }

    /**
     * @Route("/logout", name="logout")
     * @param Request $request
     * @return RedirectResponse
     */
    public function logout(Request $request) {
        $this->session->clear();
        return $this->redirectToRoute('homepage');
    }


    public function menu() {
        $twigVar = [];
        if ($this->session->has('user'))
            $twigVar['user'] = unserialize($this->session->get('user'));

        return $this->render('menu/menu.html.twig', $twigVar);
    }

}