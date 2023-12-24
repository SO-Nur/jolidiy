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
use Symfony\Component\Security\Http\Attribute\IsGranted;

class DashboardController extends AbstractDashboardController
{
    #[IsGranted('ROLE_AUTHOR')]
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        if (!$this->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->redirectToRoute('login');
        }

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

        if ($this->isGranted('ROLE_AUTHOR')) {
            yield MenuItem::subMenu('Articles', 'fas fa-newspaper')->setSubItems([
                MenuItem::linkToCrud('Tous les articles', 'fas fa-newspaper', Article::class),
                MenuItem::linkToCrud('Ajouter', 'fa-solid fa-square-plus', Article::class)
                    ->setAction(Crud::PAGE_NEW),
                MenuItem::linkToCrud('Catégories', 'fab fa-delicious', Category::class)
            ]);
        }

        if ($this->isGranted('ROLE_AUTHOR')) {
            yield MenuItem::subMenu('Médias', 'fas fa-photo-video')->setSubItems([
            MenuItem::linkToCrud('Médiathèque', 'fa-solid fa-photo-film', Media::class),
            MenuItem::linkToCrud('Ajouter', 'fa-solid fa-square-plus', Media::class)
                ->setAction(Crud::PAGE_NEW),
        ]);
        }

        if ($this->isGranted('ROLE_ADMIN')) {
            yield MenuItem::linkToCrud('Commentaires', 'fa-solid fa-comments', Comment::class);
        }

        if ($this->isGranted('ROLE_ADMIN')) {
            yield MenuItem::subMenu('Utilisateurs', 'fas fa-user')->setSubItems([
                MenuItem::linkToCrud('Tous les utilisateur', 'fa-solid fa-users', User::class),
                MenuItem::linkToCrud('Ajouter', 'fa-solid fa-square-plus', User::class)
                    ->setAction(Crud::PAGE_NEW)
            ]);
        }
    }
}
