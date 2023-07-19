<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/equitherapie', name: 'app_')]
class EquitherapieController extends AbstractController
{
    #[Route('/', name: 'equitherapie')]
    public function index(): Response
    {
        return $this->render('equitherapie/index.html.twig');
    }
}