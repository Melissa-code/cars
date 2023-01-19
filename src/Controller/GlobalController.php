<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\SignupType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Routing\Annotation\Route;

class GlobalController extends AbstractController
{
    /**
     * Home page
     *
     * @return Response
     */
    #[Route('/', name: 'app_global')]
    public function index(): Response
    {
        return $this->render('global/home.html.twig', [
        ]);
    }

    /**
     * Sign-up
     *
     * @param Request $request
     * @param ManagerRegistry $managerRegistry
     * @param UserPasswordHasherInterface $hasher
     * @return Response
     */
    #[Route('/inscription', name: 'app_signup')]
    public function signup(Request $request, ManagerRegistry $managerRegistry, UserPasswordHasherInterface $hasher): Response
    {
        $user = new User();
        $form = $this->createForm(SignupType::class, $user);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            // role_user by default (not be null)
            $user->setRoles("ROLE_USER");
            // Hash the password before to record it in the DB
            $hashedPassword = $hasher->hashPassword($user, $user->getPassword());
            $user->setPassword($hashedPassword);
            // register data in the database
            $managerRegistry->getManager()->persist($user);
            $managerRegistry->getManager()->flush();
            $this->addFlash("success", "Votre compte a bien été enregistré.");
            return $this->redirectToRoute('app_global');
        }

        return $this->render('global/signup.html.twig', [
            "form" => $form->createView(),
        ]);
    }

    /**
     * Login
     *
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     */
    #[Route('/connexion', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        return $this->render('global/login.html.twig', [
            "error" => $error,
            "lastUsername" => $lastUsername
        ]);
    }

    /**
     * Logout
     */
    #[Route('/deconnexion', name: 'app_logout')]
    public function logout(): void
    {
    }

}
