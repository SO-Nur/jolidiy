<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Comment;
use App\Form\CommentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    #[Route('/article/{slug}', name: 'app_article')]
    public function index(?Article $article): Response
    {
       /* if (!$article) {
            return $this->redirectToRoute('app_home');
        }*/

        //$comment = new Comment($article);

        //$commentForm = $this->createForm(CommentType::class, $comment);

        return $this->render('article/index.html.twig', [
            'article' => $article
        ]);
    }
}
