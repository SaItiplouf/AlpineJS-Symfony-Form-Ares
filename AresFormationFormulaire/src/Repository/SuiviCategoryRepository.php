<?php

namespace App\Repository;

use App\Entity\SuiviCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SuiviCategory>
 *
 * @method SuiviCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method SuiviCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method SuiviCategory[]    findAll()
 * @method SuiviCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SuiviCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SuiviCategory::class);
    }

    //    /**
    //     * @return SuiviCategory[] Returns an array of SuiviCategory objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('s.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?SuiviCategory
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
