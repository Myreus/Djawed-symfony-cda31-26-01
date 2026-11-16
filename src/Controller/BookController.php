<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

class BookController extends AbstractController
{
    private const array BOOKS = [
        ['id' => 1, 'title' => 'Dune', 'author' => 'Frank Herbert'],
        ['id' => 2, 'title' => '1984', 'author' => 'George Orwell'],
        ['id' => 3, 'title' => 'Fondation', 'author' => 'Isaac Asimov']
    ];

    #[Route(path: '/livres', name: 'app_books')]
    public function index(): Response
    {
        $books = $this->getBooks();
        //test si la liste des livres est vide
        //$books = [];
        return $this->render('book/index.html.twig', [
            "books" => $books
        ]);
    }

    #[Route(path: '/livres/{id}', name: 'app_book_show', requirements: ['id' => '\d+'])]
    public function show(int $id): Response
    {
        foreach (self::BOOKS as $livre) {
            if ($livre["id"] == $id) {
                $book = $livre;
            }
        }
        //Test si le livre n'existe pas
        if (!isset($book)) {
            throw $this->createNotFoundException('The book does not exist');
        }

        return $this->render('book/show.html.twig', [
            'book' => $book ?? []
        ]);
    }

    private function getBooks(): array
    {
        return [
            ['id' => 1, 'title' => 'Dune', 'author' => 'Frank Herbert'],
            ['id' => 2, 'title' => '1984', 'author' => 'George Orwell'],
            ['id' => 3, 'title' => 'Fondation', 'author' => 'Isaac Asimov'],
        ];
    }
}
