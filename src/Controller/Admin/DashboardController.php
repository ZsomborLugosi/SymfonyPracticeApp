<?php

namespace App\Controller\Admin;

use App\Entity\Episode;
use App\Entity\Movie;
use App\Entity\Series;
use App\Entity\VideoGame;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Symfony Backend Feladat');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::section('Média');
        yield MenuItem::linkToCrud('Video Games', 'fas fa-gamepad', VideoGame::class);
        yield MenuItem::linkToCrud('Movies', 'fas fa-film', Movie::class);
        yield MenuItem::linkToCrud('Series', 'fas fa-tv', Series::class);
        yield MenuItem::linkToCrud('Episodes', 'fas fa-play-circle', Episode::class);
    }
}