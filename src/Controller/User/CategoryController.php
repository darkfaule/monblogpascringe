<?php

namespace App\Controller\User;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * CategoryController is a controller made to handle category as an user.
 * 
 * @author      Rudy Boullier   <rudy.boullier@etu.univ-lyon1.fr>
 * @author      Melvyn Delpree  <melvyn.delpree@etu.univ-lyon1.fr>
 * 
 * @Route("/category", name="app_category_")
 */
class CategoryController extends AbstractController {

    /**
     * Handles the category page into a response.
     * 
     * @Route("", name="index")
     */
    public function index(): Response {
        return $this->render('base.html.twig');
    }

}

?>