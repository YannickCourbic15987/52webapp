<?php

namespace App\Controller;

use App\Entity\Ludi;
use App\Entity\Laniste;
use App\Entity\Gladiator;
use App\Form\EditGladiatorType;
use App\Form\GladiatorType;
use App\Service\RenderTimeService;
use DateTime;
use DateTimeZone;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use function PHPUnit\Framework\throwException;

class GladiatorController extends AbstractController
{   
    
    
    private Laniste $laniste;
    private Ludi $ludi;
    private Gladiator $gladiator;
    private DateTime $dateTime;
    public function __construct(
    private EntityManagerInterface $entityManager,
    private SluggerInterface $slugger,
    private Security $security,
    private RenderTimeService $renderTimeService

){
    $this->laniste = new Laniste();
    $this->ludi = new Ludi();
    $this->gladiator = new Gladiator();
    $this->dateTime = new DateTime("now" , new DateTimeZone('Europe/Paris'));
}   
    #[Route('/gladiator/add/{id}', name: 'app_add_gladiator')]
    public function add(Request $request , int $id): Response
    {   $gladiator = new Gladiator();
        

        $form = $this->createForm(GladiatorType::class, $gladiator);
        $form->handleRequest($request);
        
        //on vérifie si il assez de coin pour pouvoir acheter un gladiateur
        $ludi = $this->entityManager->getRepository($this->ludi::class)->find($id);
        $laniste = $this->entityManager->getRepository($this->laniste::class)->findBy(['email' => $this->security->getUser()->getUserIdentifier()]);
        $allGladiator = $this->entityManager->getRepository(Gladiator::class)->findBy(['ludis' => $ludi->getId()]);
     
        if($form->isSubmitted() && $form->isValid()){
            if(count($allGladiator) < 10){

                if($laniste[0]->getCoin() >= 5 ){
    
                    $updateCoin = $laniste[0]->setCoin($laniste[0]->getCoin() - 5 );
    
                    $form->getData();
                    $avatar = $form->get('avatar')->getData();
                    if($avatar){
                        $originalFilename = pathinfo($avatar->getClientOriginalName() , PATHINFO_FILENAME);
                        $safeFilename = $this->slugger->slug($originalFilename);
                        $newFilename = $safeFilename . '-' .uniqId(). '.' .$avatar->guessExtension();
                        try {
                            $avatar->move(
                            $this->getParameter('images_directory'),
                            $newFilename
                            );
                        } catch (\Exception $e) {
                           $e->getMessage();
                        }   
        
                        $form->getData()->setAvatar($newFilename);
        
                     }
                        $form->getData()->setAddress(random_int(0, 3 - 1) + (random_int(0, PHP_INT_MAX - 1) / PHP_INT_MAX));
                        $form->getData()->setStrength(random_int(0, 3 - 1) + (random_int(0, PHP_INT_MAX - 1) / PHP_INT_MAX));
                        $form->getData()->setBalance(random_int(0, 3 - 1) + (random_int(0, PHP_INT_MAX - 1) / PHP_INT_MAX));
                        $form->getData()->setSpeed(random_int(0, 3 - 1) + (random_int(0, PHP_INT_MAX - 1) / PHP_INT_MAX));
                        $form->getData()->setStrategy(random_int(0, 3 - 1) + (random_int(0, PHP_INT_MAX - 1) / PHP_INT_MAX));
                        $form->getData()->setLudis($ludi);
                        $this->entityManager->persist($form->getData());
                        $this->entityManager->persist($updateCoin);
                        $this->entityManager->flush();
                        return $this->redirectToRoute('app_profil_detail', ['id' => $id , 'successToBuy' => $form->getData()->getName()]);
                }
                else{
    
                    return $this->redirectToRoute('app_profil_detail',['id' => $id , 'errorBuyGlad' => 1 ]);
                }
            }
            else{
                return $this->redirectToRoute('app_profil_detail', ['id' => $id, 'errorNumberGlad' => 1]);
            }


            }
      
            //on récup les images 
        return $this->render('gladiator/index.html.twig', [
            'controller_name' => 'GladiatorController',
            'form' => $form
            
        ]);
    }
    #[Route('/gladiator/detail/{id}', name: 'app_detail_gladiator' ,methods:['PUT'])]
    public function detail(int $id, Request $request){
        $pj= null;
        $gladiator = $this->entityManager->getRepository($this->gladiator::class)->find($id);
        $ludi = $gladiator->getLudis();
        $speciality = $ludi->getSpeciality();
        $form = $this->createForm(EditGladiatorType::class, $this->gladiator);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $training = $form->get("choiceTraining")->getData();
            switch ($training) {
                case 'tactique':
                    if($speciality === "course de char"){
                        $pj = random_int(3, 6 - 1) + (random_int(0, PHP_INT_MAX - 1) / PHP_INT_MAX);
                    }
                    if($speciality === "athlétisme"){
                        $pj = rand(2,3);
                    }
                    if($speciality === "lutte"){
                        $pj = rand(1,3);
                    }
                    break;
                
                case 'physique':
                    if ($speciality === "course de char") {
                        $pj = rand(2,4);
                    }
                    if ($speciality === "athlétisme") {
                        $pj = rand(3,5);
                    }
                    if ($speciality === "lutte") {
                        $pj = rand(3,6);
                    }

                    break;

                case 'combine':
                    if ($speciality === "course de char") {
                        $pj = rand(2,7);
                    }
                    if ($speciality === "athlétisme") {
                        $pj = rand(3,9);
                    }
                    if ($speciality === "lutte") {
                        $pj = rand(1,5);
                    }

                    break;
                
                default:
                    break;
            }
            $pAdress = ($this->gladiator->getAddress() + 0.4) * $pj;
            $pStength = ($this->gladiator->getStrength() + 0.3) * $pj;
            $pBalance = ($this->gladiator->getBalance() - 0.1) * $pj;
            $pSpeed = ($this->gladiator->getSpeed() + 0.5 )* $pj;
            $pStategy = ($this->gladiator->getStrategy() - 0.2 )* $pj;
            $gladiatorForm = $form->getData();
            $gladiator
            ->setAddress($pAdress)
            ->setStrength($pStength)
            ->setBalance($pBalance)
            ->setSpeed($pSpeed)
            ->setStrategy($pStategy)
            ->setEdit($this->dateTime)
            ;
            $this->entityManager->persist($gladiator);
            $this->entityManager->flush();

            return $this->redirectToRoute('app_detail_gladiator', 
            ['id' => $id , 
            'successToTraining' => 1 ]);
            
        }   
       
        $renderForm = ($gladiator->getEdit() === null) ? true : $this->renderTimeService->buttonDownTime($gladiator->getEdit());
        return $this->render('gladiator/detail.html.twig',[
            'gladiator' => $gladiator,
            'speciality' => $speciality,
            'form' => $form,
            'dateEdit' => ($gladiator->getEdit() !== null) ? $gladiator->getEdit()->format('Y-m-d H:i:s') : "",
            'renderForm' => $renderForm,
            'successToTraining' => $request->query->get('successToTraining')
        ]);
    }
}

