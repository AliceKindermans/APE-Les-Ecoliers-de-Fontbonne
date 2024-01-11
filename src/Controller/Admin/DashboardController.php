<?php

namespace App\Controller\Admin;

use App\Entity\Pub;
use App\Entity\User;
use App\Entity\Child;
use App\Entity\Event;
use App\Entity\Verbatim;
use App\Entity\Association;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('APELesEcoliersDeFontbonne');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linktoRoute('Retour vers le site Internet', 'fas fa-arrow-right-from-bracket', 'app_home');
        yield MenuItem::linkToCrud('Adhérents', 'fas fa-user', User::class);
        yield MenuItem::linkToCrud('Enfants', 'fas fa-child', Child::class);
        yield MenuItem::linkToCrud('Association', 'fas fa-circle-info', Association::class);
        yield MenuItem::linkToCrud('Evénements', 'fas fa-calendar-days', Event::class);
        yield MenuItem::linkToCrud('Verbatims', 'fas fa-list', Verbatim::class);
        yield MenuItem::linkToCrud('Partenaires', 'fas fa-leanpub', Pub::class);






        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
