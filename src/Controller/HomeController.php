<?php 

namespace App\Controller;

use App\Repository\PostRepository;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * HomeController is a controller made to handle the home page.
 * 
 * @author      Rudy Boullier   <rudy.boullier@etu.univ-lyon1.fr>
 * @author      Melvyn Delpree  <melvyn.delpree@etu.univ-lyon1.fr>
 */
class HomeController extends AbstractController {

    /**
     * Handles the home page into a response.
     * 
     * @Route("/", name="app_home")
     */
    public function index(PostRepository $postRepository, CategoryRepository $categoryRepository): Response 
    {
        $posts = $postRepository->findBy([], ['id' => 'DESC'], 5);
        $categories = $categoryRepository->findAll();

        return $this->render('home/index.html.twig', [
            'posts' => $posts,
            'categories' => $categories,
        ]);
    }

}

?>