<?php

namespace App\Repository;

use App\Entity\GroupeFonctionnaliteCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<GroupeFonctionnaliteCategory>
 *
 * @method GroupeFonctionnaliteCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method GroupeFonctionnaliteCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method GroupeFonctionnaliteCategory[]    findAll()
 * @method GroupeFonctionnaliteCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GroupeFonctionnaliteCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GroupeFonctionnaliteCategory::class);
    }

    //    /**
    //     * @return GroupeFonctionnaliteCategory[] Returns an array of GroupeFonctionnaliteCategory objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('g')
    //            ->andWhere('g.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('g.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?GroupeFonctionnaliteCategory
    //    {
    //        return $this->createQueryBuilder('g')
    //            ->andWhere('g.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
