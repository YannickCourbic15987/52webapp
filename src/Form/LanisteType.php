<?php

namespace App\Form;

use App\Entity\Laniste;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class LanisteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'required' => true,
                'label' => 'votre nom',
                'attr' => ['class' => 'personnal_input '],
                "label_attr" => ['class' => "text-signUp text-uppercase fw-bold text-center w-100"]
            ])
            ->add('prename', TextType::class, [
                'required' => true,
                'label' => 'votre prénom',
                'attr' => ['class' => 'personnal_input'],
                "label_attr" => ['class' => "text-signUp text-uppercase fw-bold text-center w-100"]
            ])
            ->add('email', EmailType::class, [
                'required' => true,
                'label' => 'votre email',
                'attr' => ['class' => 'personnal_input'],
                "label_attr" => ['class' => "text-signUp text-uppercase fw-bold text-center w-100"]
            ])
            ->add('coin', HiddenType::class, [
                'data' => 10
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'les champs mot de passe ne sont pas identique , veuillez recommencez.',
                'required' => true,
                'first_options' => ['label' => 'Mot de Passe', "label_attr" => ['class' => "text-signUp text-uppercase fw-bold text-center w-100"]],
                'second_options' => ['label' => 'Mot de passe à réecrire', "label_attr" => ['class' => "text-signUp text-uppercase fw-bold text-center w-100"]],
                'attr' => ['class' => 'personnal_input'],

            ])
            ->add("Inscription", SubmitType::class, [
                'attr' => ['class' => 'personnal_btnSubmit']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Laniste::class,
            'csrf_protection' => true,
            'crsf_field_name' => '_tokenSignUp',
            'csrf_token_id' => 'task_item_SignUp',
        ]);
    }
}
