<?php

namespace App\Repository;

use App\Entity\DevoirNote;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DevoirNote>
 *
 * @method DevoirNote|null find($id, $lockMode = null, $lockVersion = null)
 * @method DevoirNote|null findOneBy(array $criteria, array $orderBy = null)
 * @method DevoirNote[]    findAll()
 * @method DevoirNote[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DevoirNoteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DevoirNote::class);
    }

    //    /**
    //     * @return DevoirNote[] Returns an array of DevoirNote objects
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

    //    public function findOneBySomeField($value): ?DevoirNote
    //    {
    //        return $this->createQueryBuilder('d')
    //            ->andWhere('d.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
