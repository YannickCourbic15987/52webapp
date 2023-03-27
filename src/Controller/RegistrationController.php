<?php

namespace App\Controller;

use App\Entity\Laniste;
use App\Form\LanisteType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegistrationController extends AbstractController
{    
    private $Laniste;
    public function __construct(){
        $this->Laniste = new Laniste();
    }

    #[Route('/registration', name: 'app_registration')]
    public function index(
        Request $request, 
        EntityManagerInterface $manager,
        UserPasswordHasherInterface $passwordHasher
        ): Response
    {   
        $form = $this->createForm(LanisteType::class , $this->Laniste);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $laniste = $form->getData();
            $hash = $passwordHasher->hashPassword(
                $laniste,
                $laniste->getPassword()
            );
            $laniste->setPassword($hash);
            $manager->persist($laniste);
            $manager->flush();
            return $this->redirectToRoute("app_login");
        }
        return $this->render('registration/index.html.twig', [
            'controller_name' => 'RegistrationController',
            'form' => $form
        ]);
    }
}
