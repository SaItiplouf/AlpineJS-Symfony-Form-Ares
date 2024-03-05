<?php

namespace App\Repository;

use App\Entity\CoursSeq;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CoursSeq>
 *
 * @method CoursSeq|null find($id, $lockMode = null, $lockVersion = null)
 * @method CoursSeq|null findOneBy(array $criteria, array $orderBy = null)
 * @method CoursSeq[]    findAll()
 * @method CoursSeq[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CoursSeqRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CoursSeq::class);
    }

    //    /**
    //     * @return CoursSeq[] Returns an array of CoursSeq objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?CoursSeq
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
