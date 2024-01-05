<?php

namespace App\Controller;

use App\Repository\PubRepository;
use App\Repository\UserRepository;
use App\Repository\VerbatimRepository;
use App\Repository\AssociationRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MemberController extends AbstractController
{
    #[Route('/member', name: 'app_member')]
    public function index(AssociationRepository $AssociationRepo, VerbatimRepository $VerbatimRepo, PubRepository $pubRepo, UserRepository $userRepo): Response
    {
    
        return $this->render('member/index.html.twig', [
            'associations' => $AssociationRepo->findAll(),
            'verbatims' => $VerbatimRepo->findAll(),
            'pubs' => $pubRepo->findAll(),
            'users' => $userRepo->findAll(),
        ]);
    }
}
