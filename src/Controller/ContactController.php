<?php

namespace App\Controller;

use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    #[Route(path:'/contact', name:'app_contact')]
    public function contact(): Response 
    {
        return $this->render('contact/index.html.twig');
    }
}
