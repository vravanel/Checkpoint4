<?php

namespace App\Form;

use App\Entity\Horse;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class HorseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'class' => ' form-control-lg',
                    'placeholder' => 'Bella, Stella,..',
                ],
            ])
            ->add('breed', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Quarter-horse,..',
                ],
            ])
            ->add('personality', TextareaType::class, [
                'attr' => [
                    'class' => 'form-floating',
                    'placeholder' => 'Calme,..',
                ],
            ])
            ->add('skill',TextareaType::class, [
                'attr' => [
                    'class' => 'form-floating',
                ],
            ])
            ->add('posterFile', VichFileType::class, [
                'required' => false,
                'allow_delete' => true,
                'download_uri' => true,
                'attr' => [
                    'class' => 'form-control'
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Horse::class,
        ]);
    }
}
