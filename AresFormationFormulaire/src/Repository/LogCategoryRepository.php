<?php

namespace App\Repository;

use App\Entity\LogCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<LogCategory>
 *
 * @method LogCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method LogCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method LogCategory[]    findAll()
 * @method LogCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LogCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LogCategory::class);
    }

    //    /**
    //     * @return LogCategory[] Returns an array of LogCategory objects
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

    //    public function findOneBySomeField($value): ?LogCategory
    //    {
    //        return $this->createQueryBuilder('l')
    //            ->andWhere('l.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
