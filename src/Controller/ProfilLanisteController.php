<?php

namespace App\Controller;

use App\Entity\Gladiator;
use App\Entity\Laniste;
use App\Entity\Ludi;
use App\Form\LudiType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfilLanisteController extends AbstractController
{   
    
    private Ludi $ludi;
    private Request $request;
    public function __construct(
        private Security $security,
        private EntityManagerInterface $entityManager,
){
    $this->ludi = new Ludi();
    $this->request = new Request();
}
    #[Route('/profil', name: 'app_profil_laniste')]
    public function index(EntityManagerInterface $entityManager , Request $request): Response
    {   
        $ludi = new Ludi();
        $laniste = $entityManager->getRepository(Laniste::class)->findBy(['email' => $this->security->getUser()->getUserIdentifier()]);
        $form = $this->createForm(LudiType::class , $ludi);
        $collectionLaniste = $laniste[0]->addLudi($ludi)->getLudis();
        $coin = $laniste[0]->getCoin();
        $form->handleRequest($request);
        


        if($form->isSubmitted() && $form->isValid()){
            $ludiForm = $form->getData();
            $ludiForm->setLanistes($laniste[0]);
            $entityManager->persist($ludiForm);
            $entityManager->persist($laniste[0]->addLudi($ludiForm));
            $entityManager->flush();
            return $this->redirectToRoute('app_profil_laniste');
        }

        return $this->render('profil_laniste/index.html.twig', [
            'controller_name' => 'ProfilLanisteController',
            'form' => $form,
            'collectionLaniste' => $collectionLaniste[0]->getId(),
            'countCollection' => count($collectionLaniste) - 1,
            'arrayLaniste' => $collectionLaniste,
            'coin' => $coin,
            'errorCoin' => $request->query->get('errorCoin')
        ]);
    }

    #[Route('/profil/add', name:"app_add_ludi")]

    public function add(Request $request){
        
        $form = $this->createForm(LudiType::class , $this->ludi);
        $laniste = $this->entityManager->getRepository(Laniste::class)->findBy(['email' => $this->security->getUser()->getUserIdentifier()]);
        $coin = $laniste[0]->getCoin();

        if($coin < 60 ){
            return $this->redirectToRoute('app_profil_laniste');
        }
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $ludiForm = $form->getData();
            $ludiForm->setLanistes($laniste[0]);
            $this->entityManager->persist($ludiForm);
            $this->entityManager->persist($laniste[0]->addLudi($ludiForm));
            $this->entityManager->flush();
            return $this->redirectToRoute('app_profil_laniste');
        }

        return $this->render('profil_laniste/addLudi.html.twig', [
            'controller_name' => 'ProfilLanisteController',
            'form' => $form
        ]);
    }

    #[Route('profil/detail/{id}', name:"app_profil_detail")]
    public function detailsLudis(int $id , Request $request){
        
        $ludi = $this->entityManager->getRepository(Ludi::class)->find($id);
        $gladiators = $this->entityManager->getRepository(Gladiator::class)->findAllGladiators($id);
        
        
        
        return $this->render('profil_laniste/detailLudi.html.twig',[
            'controller_name' => 'ProfilLanisteController',
            'ludi' => $ludi,
            'coin' => $ludi->getLanistes()->getCoin(),
            'errorBuyGlad' => $request->query->get('errorBuyGlad'),
            'successToBuy' => $request->query->get('successToBuy'),
            'errorNumberGlad' => $request->query->get('errorNumberGlad'),
            'gladiators' => $gladiators
        ]);
    }
}
