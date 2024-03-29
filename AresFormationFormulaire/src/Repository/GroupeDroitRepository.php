<?php

namespace App\Repository;

use App\Entity\GroupeDroit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<GroupeDroit>
 *
 * @method GroupeDroit|null find($id, $lockMode = null, $lockVersion = null)
 * @method GroupeDroit|null findOneBy(array $criteria, array $orderBy = null)
 * @method GroupeDroit[]    findAll()
 * @method GroupeDroit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GroupeDroitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GroupeDroit::class);
    }

    //    /**
    //     * @return GroupeDroit[] Returns an array of GroupeDroit objects
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

    //    public function findOneBySomeField($value): ?GroupeDroit
    //    {
    //        return $this->createQueryBuilder('g')
    //            ->andWhere('g.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
