<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class UserController extends AbstractController
{
    public function profile(): Response
    {
        $name = "Mathieu";
        $age = 47;
        $city = "Toulouse";
        return $this->render('user/profile.html.twig', [
            'name' => $name,
            'age' => $age,
            'city' => $city
        ]);
    }
}

