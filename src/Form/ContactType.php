<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('message', TextareaType::class, [
                'attr' => [
                    'class' => 'form-floating',
                    'placeholder' => 'Votre message',
                ],
            ])
            ->add('firstname', TextType::class, [
                'attr' => [
                    'class' => ' form-control',
                    'placeholder' => 'Votre prénom',
                ],
            ])
            ->add('lastname', TextType::class, [
                'attr' => [
                    'class' => ' form-control',
                    'placeholder' => 'Votre nom',
                ],
            ])
            ->add('email', EmailType::class, [
                'disabled' => false,
                'label' => 'E-mail*',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'exemple@exemple.fr',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
