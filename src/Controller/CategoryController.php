<?php

namespace App\Controller;

use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    #[Route('/category/{slug}', name: 'app_category')]
    public function index(?Category $category): Response
    {
        if (!$category) {
            return $this->redirectToRoute('app_home');
        }

        return $this->render('category/index.html.twig', [
            'entity' => $category
        ]);
    }
}
