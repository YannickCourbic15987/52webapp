<?php

namespace App\Repository;

use App\Entity\Ludi;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Ludi>
 *
 * @method Ludi|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ludi|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ludi[]    findAll()
 * @method Ludi[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LudiRepository extends ServiceEntityRepository
{   
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ludi::class);
    }

    public function save(Ludi $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Ludi $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Ludi[] Returns an array of Ludi objects
//     */
   public function findByLudi($id): array
   {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery(
            'SELECT * 
            FROM App\Entity\Ludi l
            WHERE l.lanistes_id = :id
            '
        )->setParameter('id' , $id);
        return $query->getResult();
   }

//    public function findOneBySomeField($value): ?Ludi
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
