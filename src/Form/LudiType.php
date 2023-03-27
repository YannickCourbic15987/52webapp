<?php

namespace App\Form;

use App\Entity\Laniste;
use App\Entity\Ludi;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LudiType extends AbstractType
{    private Laniste $laniste;
    
    public function __construct(){
        $this->laniste = new Laniste();
    }
    public function buildForm(FormBuilderInterface $builder,  array $options): void
    {
        $builder
            ->add('name', TextType::class , [
                'label' => 'Votre Nom',
            ])
            ->add('speciality', ChoiceType::class , [
                'choices' => [
                    'lutte' => 'lutte',
                    'course de char' => 'course de char',
                    'athlétisme' => 'athlétisme'
                ]
            ])
            ->add('Create', SubmitType::class , [
                'attr' => ['class' => 'btnSubmitLudi']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ludi::class,
        ]);
    }
}
