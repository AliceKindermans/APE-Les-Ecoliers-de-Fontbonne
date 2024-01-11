<?php

namespace App\Controller;

use App\Repository\PubRepository;
use App\Repository\UserRepository;
use App\Repository\VerbatimRepository;
use App\Repository\AssociationRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LegalController extends AbstractController
{
    #[Route('/legal', name: 'app_legal')]
    public function indexlegal(AssociationRepository $AssociationRepo, VerbatimRepository $VerbatimRepo, PubRepository $pubRepo, UserRepository $userRepo): Response
    {
    
        return $this->render('legal/legal.html.twig', [
            'associations' => $AssociationRepo->findAll(),
            'verbatims' => $VerbatimRepo->findAll(),
            'pubs' => $pubRepo->findAll(),
            'users' => $userRepo->findAll(),
        ]);
    }

    #[Route('/rgpd', name: 'app_rgpd')]
    public function indexRgpd(AssociationRepository $AssociationRepo, VerbatimRepository $VerbatimRepo, PubRepository $pubRepo, UserRepository $userRepo): Response
    {
    
        return $this->render('legal/rgpd.html.twig', [
            'associations' => $AssociationRepo->findAll(),
            'verbatims' => $VerbatimRepo->findAll(),
            'pubs' => $pubRepo->findAll(),
            'users' => $userRepo->findAll(),
        ]);
    }
}
