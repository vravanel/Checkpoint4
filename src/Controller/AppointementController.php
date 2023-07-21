<?php

namespace App\Controller;

use App\Entity\Appointment;
use App\Entity\User;
use App\Form\AppointmentType;
use App\Repository\AppointmentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/moncompte', name: 'app_')]
class AppointementController extends AbstractController
{
    #[Route('/rendez-vous', name: 'appointment')]
    public function index(?int $userId, AppointmentRepository $appointmentRepository): Response
    {

        $appointments = $appointmentRepository->findAll();
        return $this->render('user/appointement.html.twig', [
            'appointments' => $appointments,
            ]);
    }
    #[Route('/rendez-vous/nouveau', name: 'appointment_new')]
    public function new(Request $request, AppointmentRepository $appointmentRepository): Response
    {
        $appointments = $appointmentRepository->nbAppointment();
        $form = $this->createForm(AppointmentType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $appointmentIdSelected = $form->get('appointments')->getData();

            $this->getUser()->addAppointment($appointmentIdSelected);

            $appointmentRepository->save($appointmentIdSelected, true);

            return $this->redirectToRoute('app_appointement', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user/new.html.twig', [
            'appointments' => $appointments,
            'form' => $form,
        ]);
    }
    #[Route('/rendez-vous/{id}', name: 'appointment_delete')]
    public function delete(Request $request, Appointment $appointment, AppointmentRepository $appointmentRepository): Response
    {

        if ($this->isCsrfTokenValid('delete' . $appointment->getId(), $request->request->get('_token'))) {
            $appointmentRepository->remove($appointment, true);
        }
            return $this->redirectToRoute('app_appointement', [], Response::HTTP_SEE_OTHER);
    }
}
