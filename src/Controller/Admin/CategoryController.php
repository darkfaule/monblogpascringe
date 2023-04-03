<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Form\CategoryFormType;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * CategoryController is a controller made to handle categories as an admin.
 * 
 * @author  Rudy Boullier   <rudy.boullier@etu.univ-lyon1.fr>
 * @author  Melvyn Delpree  <melvyn.delpree@etu.univ-lyon1.fr>
 * 
 * @Route("/admin/category", name="app_admin_category_")
 */
class CategoryController extends AbstractController {

    /**
     * Handles the category page into a response.
     * 
     * @Route("", name="index")
     */
    public function index(): Response {
        return $this->render('admin/category/index.html.twig');
    }

    /**
     * Handles the create category page into a response.
     * 
     * @Route("/create", name="create")
     */
    public function create(Request $request, PostRepository $postRepository, EntityManagerInterface $em): Response {
        
        $category = new Category();
        $categoryForm = $this->createForm(CategoryFormType::class, $category, [
            'posts' => $postRepository->findAll()
        ]);

        $categoryForm->handleRequest($request);
        if ($categoryForm->isSubmitted() && $categoryForm->isValid()) {
            $category = $categoryForm->getData();

            $em->persist($category);
            $em->flush();

            return $this->redirectToRoute('app_admin_category_index');
        }

        return $this->render('admin/category/create.html.twig', [
            'category' => $category,
            'categoryForm' => $categoryForm->createView()
        ]);
    }

}

?>