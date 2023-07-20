<?php

namespace App\Controller\Admin;

use App\Entity\Horse;
use App\Form\HorseType;
use App\Repository\HorseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/horse')]
class AdminHorseController extends AbstractController
{
    #[Route('/', name: 'app_admin_horse_index', methods: ['GET'])]
    public function index(HorseRepository $horseRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $pagination = $paginator->paginate(
            $horseRepository->queryFindAll(),
            $request->query->getInt('page', 1),
            5
        );

        return $this->render('admin/admin_horse/index.html.twig', [
            'horses' => $pagination,
        ]);
    }

    #[Route('/new', name: 'app_admin_horse_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $horse = new Horse();
        $form = $this->createForm(HorseType::class, $horse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($horse);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_horse_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/admin_horse/new.html.twig', [
            'horse' => $horse,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_horse_show', methods: ['GET'])]
    public function show(Horse $horse): Response
    {
        return $this->render('admin/admin_horse/show.html.twig', [
            'horse' => $horse,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_horse_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Horse $horse, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(HorseType::class, $horse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_horse_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/admin_horse/edit.html.twig', [
            'horse' => $horse,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_horse_delete', methods: ['POST'])]
    public function delete(Request $request, Horse $horse, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$horse->getId(), $request->request->get('_token'))) {
            $entityManager->remove($horse);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_horse_index', [], Response::HTTP_SEE_OTHER);
    }
}
