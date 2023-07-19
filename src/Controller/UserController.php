<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/moncompte', name: 'app_')]
class UserController extends AbstractController
{
    #[Route('/', name: 'user')]
    public function index(): Response
    {
        return $this->render('user/index.html.twig');
    }
    #[Route('/informations', name: 'information')]
    public function account(): Response
    {
        return $this->render('user/account.html.twig');
    }
}
