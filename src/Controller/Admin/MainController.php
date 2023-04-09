<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * MainController is a controller made to handle the manage page.
 * 
 * @author      Rudy Boullier   <rudy.boullier@etu.univ-lyon1.fr>
 * @author      Melvyn Delpree  <melvyn.delpree@etu.univ-lyon1.fr>
 */
class MainController extends AbstractController
{
    /**
     * Handles the manage page into a response.
     * 
     * @Route("/admin", name="app_admin_index")
     */
    public function index(): Response
    {
        return $this->render('admin/index.html.twig');
    }
}
