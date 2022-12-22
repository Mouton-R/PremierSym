<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    #[Route('/blog', name: 'blog')]
    public function index(ArticleRepository $repo)
    {
        $articles = $repo->findAll();

        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
            'articles' => $articles
        ]);
    }
    #[Route('/', name: 'home')]
    public function home() {
        return $this->render('blog/home.html.twig');
    }
    
    #[Route('/blog/new', name:'blog_create')]
    public function create() {
        return $this->render('blog/create.html.twig');
    }
    
    #[Route('/blog/{id}', name:'blog_show')]
    public function show(ManagerRegistry $doctrine, int $id): Response {
        // public function show(Article $article) -> permet de supprimer la ligne du dessous grace au ParamConverter
        $article = $doctrine->getRepository(Article::class)->find($id);

        return $this->render('blog/show.html.twig', [
            'article' => $article 
        ]);
    }


}
