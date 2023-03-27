<?php

namespace App\Controller;

use App\Entity\Gladiator;
use DateTime;
use DateTimeZone;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CircleGameController extends AbstractController
{   

    private DateTime $dateTime;
    private Gladiator $gladiator;

    public function __construct(
        private EntityManagerInterface $entityManager,
    ){
        $this->gladiator = new Gladiator();
        $this->dateTime = new DateTime("now", new DateTimeZone('Europe/Paris'));
    }
    #[Route('/game', name: 'app_circle_game')]
    public function index(): Response
    {   
        $choiceStage= null;
        $gladiators = $this->entityManager->getRepository($this->gladiator::class)->findAll(); 
        $event = ((int)$this->dateTime->format('H') >= 18  && (int)$this->dateTime->format('H') <= 24) ? true : false;
        // $this->dateTime->format('H') === 18
        if((int)$this->dateTime->format('H') === 18){
            $tirage = rand(0,2);
            $stage = ['course de char','lutte', 'atlhétisme'];
            $choiceStage = $stage[$tirage];
            $PerfVictory = $this->entityManager->getRepository($this->gladiator::class)->findVictoryGladiator();
            $selectGladiaditorVictory = $this->entityManager->getRepository($this->gladiator::class)->find($PerfVictory[0]['id']);
            foreach ($gladiators as  $gladiator) {
                switch ($choiceStage) {
                    case 'course de char':
                        $factoryChance = random_int(0.0000, 0.9999 - 1) + (random_int(0, PHP_INT_MAX - 1) / PHP_INT_MAX);
                        $perfomance = (0.8 * $gladiator->getAddress()) + $gladiator->getBalance() + (0.3 * $gladiator->getStrength()) + 0.1 * $gladiator->getSpeed() + $factoryChance;
                        $gladiator->setPerfomance($perfomance);
                        $this->entityManager->persist($gladiator);
                        $this->entityManager->flush();
                        break;
                    case 'lutte':
                        $factoryChance =
                        random_int(0, 1 - 1) + (random_int(0, PHP_INT_MAX - 1) / PHP_INT_MAX);
                        $perfomance = (0.3 * $gladiator->getAddress()) + (0.1 * $gladiator->getBalance()) + (0.8 * $gladiator->getStrength()) + (0.4 * $gladiator->getSpeed()) + $factoryChance;
                        $this->entityManager->persist($gladiator);
                        $this->entityManager->flush();
                        break;
                    case 'atlhétisme':
                        $factoryChance =
                            random_int(0, 1 - 1) + (random_int(0, PHP_INT_MAX - 1) / PHP_INT_MAX);
                        $perfomance = (0.4 * $gladiator->getAddress()) + (0.4 * $gladiator->getBalance()) + (0.4 * $gladiator->getStrength()) + (0.4 * $gladiator->getSpeed()) + $factoryChance;
                        $this->entityManager->persist($gladiator);
                        $this->entityManager->flush();
                        break;
                }
            }
            switch ($choiceStage) {
                case 'course de char':
                    $coin = $selectGladiaditorVictory->getLudis()->getLanistes()->getCoin();
                    $selectGladiaditorVictory->getLudis()->getLanistes()->setCoin($coin + 2);
                    $selectGladiaditorVictory
                    ->setBalance(1);
                    $this->entityManager->persist($selectGladiaditorVictory);
                    $this->entityManager->flush();
                    break;
                
                case 'lutte':
                    $coin = $selectGladiaditorVictory->getLudis()->getLanistes()->getCoin();
                    $selectGladiaditorVictory->getLudis()->getLanistes()->setCoin($coin +2);
                    $selectGladiaditorVictory
                    ->setStrength(1);
                    break;
                
                case 'atlhétisme':
                    $coin = $selectGladiaditorVictory->getLudis()->getLanistes()->getCoin();
                    $selectGladiaditorVictory->getLudis()->getLanistes()->setCoin($coin + 2);
                    $selectGladiaditorVictory
                    ->setAddress(0.2)
                    ->setStrength(0.2)
                    ->setBalance(0.2)
                    ->setSpeed(0.2)
                    ->setStrategy(0.2);
                    break;
            }
            
        }


        $PerfVictory = $this->entityManager->getRepository($this->gladiator::class)->findVictoryGladiator(); 
        $selectGladiaditorVictory = $this->entityManager->getRepository($this->gladiator::class)->find($PerfVictory[0]['id']);
        dump($selectGladiaditorVictory->getLudis()->getLanistes()->getCoin());

        // if($selectGladiaditorVictory )
        return $this->render('circle_game/index.html.twig', [
            'controller_name' => 'CircleGameController',
            'event' => $event,
            'champion' => $selectGladiaditorVictory,
            'laniste' => $selectGladiaditorVictory->getLudis()->getLanistes()->getName()
            
        ]);
    }
}
