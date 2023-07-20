<?php

namespace App\Form;

use App\Entity\Appointment;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AppointmentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $appointmentDates = $options['appointmentDates'];

        $builder->add('date', ChoiceType::class, [
            'attr' => ['class' => 'form-select form-select-lg mb-3'],
            'choices' => array_combine($appointmentDates, $appointmentDates),
        ]);

    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Appointment::class,
            'appointmentDates' => [],

        ]);
    }
}
