<?php

namespace App\Repository;

use App\Entity\CoursDistance;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CoursDistance>
 *
 * @method CoursDistance|null find($id, $lockMode = null, $lockVersion = null)
 * @method CoursDistance|null findOneBy(array $criteria, array $orderBy = null)
 * @method CoursDistance[]    findAll()
 * @method CoursDistance[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CoursDistanceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CoursDistance::class);
    }

    //    /**
    //     * @return CoursDistance[] Returns an array of CoursDistance objects
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

    //    public function findOneBySomeField($value): ?CoursDistance
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
