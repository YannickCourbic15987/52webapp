<?php

namespace App\Repository;

use App\Entity\LudisLanistes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<LudisLanistes>
 *
 * @method LudisLanistes|null find($id, $lockMode = null, $lockVersion = null)
 * @method LudisLanistes|null findOneBy(array $criteria, array $orderBy = null)
 * @method LudisLanistes[]    findAll()
 * @method LudisLanistes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LudisLanistesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LudisLanistes::class);
    }

    public function save(LudisLanistes $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(LudisLanistes $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return LudisLanistes[] Returns an array of LudisLanistes objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('l.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?LudisLanistes
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
