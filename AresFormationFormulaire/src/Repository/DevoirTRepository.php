<?php

namespace App\Repository;

use App\Entity\DevoirT;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DevoirT>
 *
 * @method DevoirT|null find($id, $lockMode = null, $lockVersion = null)
 * @method DevoirT|null findOneBy(array $criteria, array $orderBy = null)
 * @method DevoirT[]    findAll()
 * @method DevoirT[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DevoirTRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DevoirT::class);
    }

    //    /**
    //     * @return DevoirT[] Returns an array of DevoirT objects
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

    //    public function findOneBySomeField($value): ?DevoirT
    //    {
    //        return $this->createQueryBuilder('d')
    //            ->andWhere('d.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
