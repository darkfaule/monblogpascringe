<?php

namespace App\Controller\User;

use App\Entity\Post;
use App\Entity\Comment;
use App\Form\CommentFormType;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * PostController is a controller made to handle post as an user.
 * 
 * @author      Rudy Boullier   <rudy.boullier@etu.univ-lyon1.fr>
 * @author      Melvyn Delpree  <melvyn.delpree@etu.univ-lyon1.fr>
 * 
 * @Route("/post", name="app_post_")
 */
class PostController extends AbstractController {

    /**
     * Handles the show post page into a response.
     * 
     * @Route("/show/{slug}", name="show")
     */
    public function show(Post $post, Request $request, EntityManagerInterface $em): Response {
        $comments = $post->getComments();

        $comment = new Comment();
        $commentForm = $this->createForm(CommentFormType::class, $comment);
        $commentForm->handleRequest($request);

        if ($commentForm->isSubmitted() && $commentForm->isValid()) {
            $comment->setIsValid(true);
            $comment->setPost($post);
            $comment->setUsername($this->getUser()->getUsername());
            $em->persist($comment);
            $em->flush();

            return $this->redirectToRoute('app_post_show', ['slug' => $post->getSlug()]);
        }

        return $this->render('user/post/show.html.twig', [
            'post' => $post,
            'comments' => $comments,
            'commentForm' => $commentForm->createView()
        ]);
    }

    /**
     * Handles the show post page into a response.
     * 
     * @Route("/list", name="list")
     */
    public function list(PostRepository $postRepository): Response {
        return $this->render('user/post/list.html.twig', [
            'posts' => $postRepository->findBy([], 
                ['id' => 'DESC'])
        ]);
    }

}

?>