<?php

namespace App\Controller\Admin;

use App\Entity\Post;
use App\Form\PostFormType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * PostController is a controller made to handle post as an admin.
 * 
 * @author  Rudy Boullier   <rudy.boullier@etu.univ-lyon1.fr>
 *          Melvyn Delpree  <melvyn.delpree@etu.univ-lyon1.fr>
 * 
 * @Route("/admin/post", name="app_admin_post_")
 */
class PostController extends AbstractController 
{
    /**
     * Handles the post page into a response.
     * 
     * @Route("", name="index")
     */
    public function index(): Response 
    {
        return $this->render('base.html.twig');
    }

    /**
     * Handles the create post page into a response.
     * 
     * @Route("/create", name="create")
     */
    public function create(Request $request, CategoryRepository $categoryRepository, EntityManagerInterface $em, SluggerInterface $slugger): Response 
    {
        $post = new Post();
        $postForm = $this->createForm(PostFormType::class, $post, [
            'categories' => $categoryRepository->findAll()
        ]);
        $postForm->handleRequest($request);

        if ($postForm->isSubmitted() && $postForm->isValid()) {
            $slug = $slugger->slug($post->getTitle());
            $post->setSlug($slug);

            $post->setUser($this->getUser());

            $categories = $postForm->get('categories')->getData();

            foreach ($categories as $category) {
                $post->addCategory($category);
            }
            $post->setPublishedAt(new \DateTimeImmutable('now'));


            $em->persist($post);
            $em->flush();

            return $this->redirectToRoute('app_admin_post_index');
        }

        return $this->render('admin/post/create.html.twig', [
            'postForm' => $postForm->createView()
        ]);
    }

    /**
     * Handles the create post page into a response.
     * 
     * @Route("/edit/{id}", name="edit")
     */
    public function edit(Post $post, Request $request, EntityManagerInterface $em, SluggerInterface $slugger): Response 
    {
        $postForm = $this->createForm(PostFormType::class, $post);

        $postForm->handleRequest($request);

        if ($postForm->isSubmitted() && $postForm->isValid()) {
            $slug = $slugger->slug($post->getTitle());
            $post->setSlug($slug);

            $post->setUser($this->getUser());

            $selectedCategories = $postForm->get('categories')->getData();

            foreach ($selectedCategories as $category) {
                $post->addCategory($category);
            }

            $em->persist($post);
            $em->flush();

            return $this->redirectToRoute('app_admin_post_index');
        }

        return $this->render('admin/post/edit.html.twig', [
            'postForm' => $postForm->createView()
        ]);
    }
}