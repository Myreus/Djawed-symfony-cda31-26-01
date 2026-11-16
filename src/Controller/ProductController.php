<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

class ProductController extends AbstractController
{
    #[Route(path:'/produit/{id}', name:'app_product_show', requirements: ['id'=> '\d+'] )]
    public function show(int $id): Response
    {
        return $this->render('product/index.html.twig', [
            'id' => $id
        ]);
    }
}
