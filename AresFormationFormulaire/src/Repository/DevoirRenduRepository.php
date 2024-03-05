<?php

namespace App\Repository;

use App\Entity\DevoirRendu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DevoirRendu>
 *
 * @method DevoirRendu|null find($id, $lockMode = null, $lockVersion = null)
 * @method DevoirRendu|null findOneBy(array $criteria, array $orderBy = null)
 * @method DevoirRendu[]    findAll()
 * @method DevoirRendu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DevoirRenduRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DevoirRendu::class);
    }

    //    /**
    //     * @return DevoirRendu[] Returns an array of DevoirRendu objects
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

    //    public function findOneBySomeField($value): ?DevoirRendu
    //    {
    //        return $this->createQueryBuilder('d')
    //            ->andWhere('d.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
