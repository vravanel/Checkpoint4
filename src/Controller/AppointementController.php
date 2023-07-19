<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/moncompte', name: 'app_')]
class AppointementController extends AbstractController
{
    #[Route('/rendez-vous', name: 'appointement')]
    public function index(): Response
    {
        return $this->render('user/appointement.html.twig');
    }
}
