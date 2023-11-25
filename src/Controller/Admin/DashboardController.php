<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Comment;
use App\Entity\Media;
use App\Entity\Project;
use App\Entity\Step;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(ArticleCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Joli DIY');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToRoute('Retour à l\'accueil', 'fa fa-home', 'app_home');

        yield MenuItem::subMenu('Articles', 'fas fa-newspaper')->setSubItems([
            MenuItem::linkToCrud('Tous les articles', 'fas fa-newspaper', Article::class),
            MenuItem::linkToCrud('Ajouter', 'fa-solid fa-square-plus', Article::class)
                ->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Catégories', 'fas fa-list', Category::class)
        ]);

        yield MenuItem::subMenu('Médias', 'fas fa-photo-video')->setSubItems([
            MenuItem::linkToCrud('Médiathèque', 'fa-solid fa-photo-film', Media::class),
            MenuItem::linkToCrud('Ajouter', 'fa-solid fa-square-plus', Media::class)
                ->setAction(Crud::PAGE_NEW),
        ]);

        yield MenuItem::linkToCrud('Commentaires', 'fa-solid fa-comments', Comment::class);

        yield MenuItem::subMenu('Utilisateurs', 'fas fa-user')->setSubItems([
            MenuItem::linkToCrud('Tous les comptes', 'fa-solid fa-users', User::class),
            MenuItem::linkToCrud('Ajouter', 'fa-solid fa-square-plus', User::class)
                ->setAction(Crud::PAGE_NEW)
        ]);
    }
}
