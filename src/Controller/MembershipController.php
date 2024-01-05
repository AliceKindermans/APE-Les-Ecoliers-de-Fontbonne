<?php

namespace App\Controller;

use App\Entity\Child;
use App\Entity\User;
use App\Form\ChildType;
use App\Form\UserType;
use App\Repository\PubRepository;
use App\Repository\UserRepository;
use App\Repository\VerbatimRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\AssociationRepository;
use App\Repository\ChildRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/*class MembershipController extends AbstractController
{
    #[Route('/membership', name: 'app_membership')]
    public function index(AssociationRepository $AssociationRepo, VerbatimRepository $VerbatimRepo, PubRepository $pubRepo, UserRepository $userRepo, ChildRepository $childRepo, Request $request, EntityManagerInterface $manager,): Response
    {
        $user = new User();
        $userForm = $this->createForm(UserType::class, $user);

        $userForm ->handleRequest($request);
        if ($userForm->isSubmitted() && $userForm->isValid()){
            $user = $userForm->getData();
            $manager->persist($user);
            $manager->flush();
        
            $this->addFlash(
                'success',
                'Votre adhésion a bien été prise en compte');

            return $this->redirectToRoute('app_home');
        }

        $child = new Child();
        $childForm = $this->createForm(ChildType::class, $child);

        $childForm ->handleRequest($request);
        if ($childForm->isSubmitted() && $userForm->isValid()){
            $child = $childForm->getData();
            $manager->persist($child);
            $manager->flush();
        
            $this->addFlash(
                'success',
                'L\'enregistrement de vos enfants a bien été pris en compte');

            return $this->redirectToRoute('app_home');
        }

        return $this->render('membership/index.html.twig', [
            'associations' => $AssociationRepo->findAll(),
            'verbatims' => $VerbatimRepo->findAll(),
            'pubs' => $pubRepo->findAll(),
            'users' => $userRepo->findAll(),
            'userForm' => $userForm->createView(),
            'childForm' => $childForm->createView()
        ]);
    }
}*/


class MembershipController extends AbstractController
{
    #[Route('/membership', name: 'app_membership')]
    public function index(AssociationRepository $AssociationRepo, VerbatimRepository $VerbatimRepo, PubRepository $pubRepo, Request $request, EntityManagerInterface $manager): Response
    {
        $user = new User();
    $userForm = $this->createForm(UserType::class, $user);

    $userForm->handleRequest($request);

    if ($userForm->isSubmitted() && $userForm->isValid()) {
        $children = $user->getChildren();

        foreach ($children as $child) {
            
            $child->addUser($user);
            $manager->persist($child);
        }

        $manager->persist($user);
        $manager->flush();

            $this->addFlash(
                'success',
                'Votre adhésion a bien été prise en compte. Nous vous en remercions.'
            );

            return $this->redirectToRoute('app_home');
        }else {
            $this->addFlash('error', 'Le formulaire n\'est pas valide.');
        }

        return $this->render('membership/index.html.twig', [
            'associations' => $AssociationRepo->findAll(),
            'verbatims' => $VerbatimRepo->findAll(),
            'pubs' => $pubRepo->findAll(),
            'userForm' => $userForm->createView(),
        ]);
    } 
}
