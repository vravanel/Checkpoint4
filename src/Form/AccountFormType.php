<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class AccountFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => 'Prénom*',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom*',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('phone', TextType::class, [
                'label' => 'Téléphone*',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('adress', TextType::class, [
                'label' => 'Adresse*',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('city', TextType::class, [
                'label' => 'Ville*',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('cityCode', IntegerType::class, [
                'label' => 'Code Postal*',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('email', EmailType::class, [
                'label' => 'E-mail',
                'attr' => ['class' => 'form-control'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {

        $resolver->setDefaults([
            'data_class' => User::class,
            'password_enabled' => false,
            'is_edit' => true,
        ]);
    }
}
