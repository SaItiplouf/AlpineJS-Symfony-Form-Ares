<?php

namespace App\Repository;

use App\Entity\GroupeFonctionnalite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<GroupeFonctionnalite>
 *
 * @method GroupeFonctionnalite|null find($id, $lockMode = null, $lockVersion = null)
 * @method GroupeFonctionnalite|null findOneBy(array $criteria, array $orderBy = null)
 * @method GroupeFonctionnalite[]    findAll()
 * @method GroupeFonctionnalite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GroupeFonctionnaliteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GroupeFonctionnalite::class);
    }

    //    /**
    //     * @return GroupeFonctionnalite[] Returns an array of GroupeFonctionnalite objects
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

    //    public function findOneBySomeField($value): ?GroupeFonctionnalite
    //    {
    //        return $this->createQueryBuilder('g')
    //            ->andWhere('g.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
