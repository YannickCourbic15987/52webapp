<?php

namespace App\Form;

use App\Entity\Gladiator;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class GladiatorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Votre Nom'
            ])
            ->add('avatar', FileType::class, [
            'label' => 'Votre Avatar',
            'multiple' => false,
            'required' => false,
            'mapped' => false,
            'constraints' => [
                new File([
                    'maxSize' => '1024k',
                    'mimeTypes' => [
                        'image/png',
                        'image/jpeg',
                        'image/webp',
                        'image/gif'
                    ],
                    'mimeTypesMessage' => 'Les avatar supporté sont seulement en .png, .jpeg .webp .gif'

                ]),
            ]
            ])
            ->add('create' , SubmitType::class, ['attr' => ['class' => 'btnSubmitLudi']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Gladiator::class,
        ]);
    }
}
