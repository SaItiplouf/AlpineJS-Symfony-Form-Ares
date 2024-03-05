<?php

namespace App\Repository;

use App\Entity\DevoirQcm;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DevoirQcm>
 *
 * @method DevoirQcm|null find($id, $lockMode = null, $lockVersion = null)
 * @method DevoirQcm|null findOneBy(array $criteria, array $orderBy = null)
 * @method DevoirQcm[]    findAll()
 * @method DevoirQcm[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DevoirQcmRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DevoirQcm::class);
    }

    //    /**
    //     * @return DevoirQcm[] Returns an array of DevoirQcm objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('d')
    //            ->andWhere('d.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('d.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?DevoirQcm
    //    {
    //        return $this->createQueryBuilder('d')
    //            ->andWhere('d.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
