<?php

namespace App\Controller;

use App\Repository\PubRepository;
use App\Repository\UserRepository;
use App\Repository\EventRepository;
use App\Repository\VerbatimRepository;
use App\Repository\AssociationRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    
    #[Route('/connexion', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils,AssociationRepository $AssociationRepo, VerbatimRepository $VerbatimRepo, PubRepository $pubRepo, UserRepository $userRepo, EventRepository $eventRepo): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername, 
            'error' => $error,
            'events' => $eventRepo->findAll(),
            'associations' => $AssociationRepo->findAll(),
            'verbatims' => $VerbatimRepo->findAll(),
            'pubs' => $pubRepo->findAll(),
            'users' => $userRepo->findAll(),
        ]);
    }


    #[Route("/deconnexion", name: "app_logout")]
    public function logout(): void
    {
        // Le code dans cette méthode n'est jamais exécuté.
        // Il est seulement nécessaire que la route existe.
    }
}

