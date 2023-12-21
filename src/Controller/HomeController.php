<?php

namespace App\Controller;

use App\Repository\VerbatimRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\AssociationRepository;
use App\Repository\PubRepository;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(AssociationRepository $AssociationRepo, VerbatimRepository $VerbatimRepo, PubRepository $pubRepo, UserRepository $userRepo): Response
    {
    
        return $this->render('home/index.html.twig', [
            'associations' => $AssociationRepo->findAll(),
            'verbatims' => $VerbatimRepo->findAll(),
            'pubs' => $pubRepo->findAll(),
            'users' => $userRepo->findAll(),
        ]);
    }
}
