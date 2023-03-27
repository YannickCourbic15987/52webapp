<?php

namespace App\Form;

use App\Entity\Gladiator;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditGladiatorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('choiceTraining', ChoiceType::class,[ 
                'attr' => ['class' => 'form-select bg-yellowGold text-signUp'],
                'choices' => [
                'entraînement physique'=> 'physique',
                'entraînement tactique' => 'tactique',
                'entraînement combiné'=> "combine"
                ], 
                'mapped'=> false,
                'label' => false

            ])
           ->add('training' , SubmitType::class , [
            'label' => 'entraînement',
            "attr" => ["class" => "btn btn-signUp text-yellowGold fw-bolder p-3", 'id' => 'btnTrain']
           ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Gladiator::class,
        ]);
    }
}
