<?php

namespace App\Controller;

use App\Repository\PubRepository;
use App\Repository\UserRepository;
use App\Repository\VerbatimRepository;
use App\Repository\AssociationRepository;
use App\Repository\EventRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EventController extends AbstractController
{
    #[Route('/event', name: 'app_event')]
    public function index(AssociationRepository $AssociationRepo, VerbatimRepository $VerbatimRepo, PubRepository $pubRepo, UserRepository $userRepo, EventRepository $eventRepo): Response
    {
        return $this->render('event/index.html.twig', [
            'events' => $eventRepo->findAll(),
            'associations' => $AssociationRepo->findAll(),
            'verbatims' => $VerbatimRepo->findAll(),
            'pubs' => $pubRepo->findAll(),
            'users' => $userRepo->findAll(),
        ]);
    }
}

