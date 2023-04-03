<?php

namespace App\Controller\User;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * CommentController is a controller made to handle comment as an user.
 * 
 * @author      Rudy Boullier   <rudy.boullier@etu.univ-lyon1.fr>
 * @author      Melvyn Delpree  <melvyn.delpree@etu.univ-lyon1.fr>
 * 
 * @Route("/comment", name="app_comment_")
 */
class CommentController extends AbstractController {

    /**
     * Handles the comment page into a response.
     * 
     * @Route("", name="index")
     */
    public function index(): Response {
        return $this->render('base.html.twig');
    }

}

?>