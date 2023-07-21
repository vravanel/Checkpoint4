<?php

namespace App\Controller;

use App\Form\AccountFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

#[Route('/moncompte', name: 'app_')]
class AccountController extends AbstractController
{
    #[Route('/informations', name: 'account_information')]
    public function index(UserInterface $user, Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AccountFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'Votre modification a bien été prise en compte.');
            return $this->redirectToRoute('app_account_information');
        }

        return $this->render('account/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}
