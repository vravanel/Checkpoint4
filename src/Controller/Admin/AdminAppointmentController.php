<?php

namespace App\Controller\Admin;

use App\Entity\Appointment;
use App\Form\Appointment1Type;
use App\Repository\AppointmentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/appointment')]
class AdminAppointmentController extends AbstractController
{
    #[Route('/', name: 'app_admin_appointment_index', methods: ['GET'])]
    public function index(
        AppointmentRepository $appointmentRepository,
        PaginatorInterface $paginator, Request $request
    ): Response
    {
        $pagination = $paginator->paginate(
            $appointmentRepository->queryFindAll(),
            $request->query->getInt('page', 1),
            5
        );

        return $this->render('admin/admin_appointment/index.html.twig', [
            'appointments' => $pagination,
        ]);
    }

    #[Route('/new', name: 'app_admin_appointment_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $appointment = new Appointment();
        $form = $this->createForm(Appointment1Type::class, $appointment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($appointment);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_appointment_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/admin_appointment/new.html.twig', [
            'appointment' => $appointment,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_appointment_show', methods: ['GET'])]
    public function show(Appointment $appointment): Response
    {
        return $this->render('admin/admin_appointment/show.html.twig', [
            'appointment' => $appointment,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_appointment_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Appointment $appointment, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Appointment1Type::class, $appointment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_appointment_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/admin_appointment/edit.html.twig', [
            'appointment' => $appointment,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_appointment_delete', methods: ['POST'])]
    public function delete(Request $request, Appointment $appointment, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$appointment->getId(), $request->request->get('_token'))) {
            $entityManager->remove($appointment);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_appointment_index', [], Response::HTTP_SEE_OTHER);
    }
}
