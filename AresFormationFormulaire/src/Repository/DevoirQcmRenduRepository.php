<?php

namespace App\Repository;

use App\Entity\DevoirQcmRendu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DevoirQcmRendu>
 *
 * @method DevoirQcmRendu|null find($id, $lockMode = null, $lockVersion = null)
 * @method DevoirQcmRendu|null findOneBy(array $criteria, array $orderBy = null)
 * @method DevoirQcmRendu[]    findAll()
 * @method DevoirQcmRendu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DevoirQcmRenduRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DevoirQcmRendu::class);
    }

    //    /**
    //     * @return DevoirQcmRendu[] Returns an array of DevoirQcmRendu objects
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

    //    public function findOneBySomeField($value): ?DevoirQcmRendu
    //    {
    //        return $this->createQueryBuilder('d')
    //            ->andWhere('d.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
