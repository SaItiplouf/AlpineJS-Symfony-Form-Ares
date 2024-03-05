<?php

namespace App\Repository;

use App\Entity\SalleCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SalleCategory>
 *
 * @method SalleCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method SalleCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method SalleCategory[]    findAll()
 * @method SalleCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SalleCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SalleCategory::class);
    }

    //    /**
    //     * @return SalleCategory[] Returns an array of SalleCategory objects
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

    //    public function findOneBySomeField($value): ?SalleCategory
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
