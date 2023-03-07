<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    #[Route('/hello/{name}', methods: ['GET'])]
    public function index(string $name): Response
    {
        return new Response("Hello $name!");
    }


    public function name($name) {
    	return $this->render('hello/base.html.twig', ['name' => $name]);
    }
}