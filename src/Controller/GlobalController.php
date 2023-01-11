<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\SignupType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
     * Sign-up form page
     *
     * @param Request $request
     * @param ManagerRegistry $managerRegistry
     * @return Response
     */
    #[Route('/inscription', name: 'app_signup')]
    public function signup(Request $request, ManagerRegistry $managerRegistry): Response
    {
        $user = new User();
        $form = $this->createForm(SignupType::class, $user);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $user->setRoles("ROLE_USER");
            $managerRegistry->getManager()->persist($user);
            $managerRegistry->getManager()->flush();
            $this->addFlash("success", "Votre compte a bien été enregistré.");
            return $this->redirectToRoute('app_global');
        }

        return $this->render('global/signup.html.twig', [
            "form" => $form->createView(),

        ]);
    }
}
