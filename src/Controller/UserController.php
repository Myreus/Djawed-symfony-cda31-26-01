<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Service\UserService;

final class UserController extends AbstractController
{
    public function __construct(
        private readonly UserService $userService
    )  {}

    #[Route(path:'/users', name: 'app_users')]
    public function showAllUsers(): Response
    {
        //Récupération de toutes les catégories de la BDD
        $users = $this->userService->getUsers();

        return $this->render('user/users.html.twig',[
            'users' => $users
        ]);
    }

    #[Route(path:'/users/{id}', name: 'app_users')]
    public function showUserById(int $id): Response
    {
        //Récupération de toutes les catégories de la BDD
        $user = $this->userService->getUserById($id);

        return $this->render('user/users.html.twig',[
            'users' => $user
        ]);
    }
}
