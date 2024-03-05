<?php

namespace App\Repository;

use App\Entity\EnqueteQcm;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EnqueteQcm>
 *
 * @method EnqueteQcm|null find($id, $lockMode = null, $lockVersion = null)
 * @method EnqueteQcm|null findOneBy(array $criteria, array $orderBy = null)
 * @method EnqueteQcm[]    findAll()
 * @method EnqueteQcm[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EnqueteQcmRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EnqueteQcm::class);
    }

    //    /**
    //     * @return EnqueteQcm[] Returns an array of EnqueteQcm objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('e.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?EnqueteQcm
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
