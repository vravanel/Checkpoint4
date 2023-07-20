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
    #[Route('/rendez-vous', name: 'appointement')]
    public function index(?int $userId, AppointmentRepository $appointmentRepository): Response
    {

        $appointments = $appointmentRepository->findAll();
        return $this->render('user/appointement.html.twig', [
            'appointments' => $appointments,
            ]);
    }
    #[Route('/rendez-vous/nouveau', name: 'appointement_new')]
    public function new(Request $request, AppointmentRepository $appointmentRepository): Response
    {
        $appointments = $appointmentRepository->findAll();

        $appointmentDates = [];
        foreach ($appointments as $appointment) {
            $appointmentDates[] = $appointment->getDate()->format('d-m-Y H:i:s');
        }

        $appointment = new Appointment();
        $form = $this->createForm(AppointmentType::class, $appointment, ['appointmentDates' => $appointmentDates]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->addFlash('success', 'Votre rendez vous du ' . $appointment->getDate() . ' a été ajouté avec succès.');

            $appointmentRepository->save($appointment, true);

            return $this->redirectToRoute('app_appointement', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user/new.html.twig', [
            'appointment' => $appointment,
            'form' => $form,
        ]);
    }
}
