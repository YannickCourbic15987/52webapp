<?php

namespace App\Repository;

use App\Entity\Gladiator;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Gladiator>
 *
 * @method Gladiator|null find($id, $lockMode = null, $lockVersion = null)
 * @method Gladiator|null findOneBy(array $criteria, array $orderBy = null)
 * @method Gladiator[]    findAll()
 * @method Gladiator[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GladiatorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Gladiator::class);
    }

    public function save(Gladiator $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Gladiator $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Gladiator[] Returns an array of Gladiator objects
//     */
   public function findAllGladiators($id): array
   {
       return $this->createQueryBuilder('g')
           ->andWhere('g.ludis = :id')
           ->setParameter(':id', $id)
           ->getQuery()
           ->getResult()
       ;
   }

   public function findVictoryGladiator(){
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery(
            'SELECT g.id, MAX(g.perfomance) 
            FROM App\Entity\Gladiator g
            GROUP BY g.id 
            ORDER BY MAX(g.perfomance) 
            DESC 
            '
        )->setMaxResults(1);
        
        return $query->getResult();
   }

   public function findMaxSpeed(){
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery(
            'SELECT g.id, MAX(g.speed) 
            FROM App\Entity\Gladiator g
            GROUP BY g.id 
            ORDER BY MAX(g.speed) 
            DESC'
        );
        return $query->getMaxResults(1);
   }

 

//    public function findOneBySomeField($value): ?Gladiator
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
