<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    public function index(): Response 
    {
        //exercice 1
        //return new Response('Bienvenue sur mon application Symfony');
        return $this->render('home/index.html.twig');
    }
}
