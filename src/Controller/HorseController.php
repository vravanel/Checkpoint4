<?php

namespace App\Controller;

use App\Repository\HorseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HorseController extends AbstractController
{
    #[Route('/horse', name: 'app_horse')]
    public function index(HorseRepository $horseRepository): Response
    {
        $horses = $horseRepository->findAll();
        return $this->render('horse/index.html.twig', [
            'horses' => $horses,
        ]);
    }
}
