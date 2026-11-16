<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

class BookController extends AbstractController
{
    #[Route(path: '/livres', name: 'app_books')]
    public function index(): Response
    {
        $books = [
            ['id' => 1, 'title' => 'Dune', 'author' => 'Frank Herbert'],
            ['id' => 2, 'title' => '1984', 'author' => 'George Orwell'],
            ['id' => 3, 'title' => 'Fondation', 'author' => 'Isaac Asimov'],
        ];
        //test si la liste des livres est vide
        //$books = [];
        return $this->render('book/index.html.twig', [
            "books"=> $books
        ]);
    }
}
