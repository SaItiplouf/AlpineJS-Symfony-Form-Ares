<?php

namespace App\Repository;

use App\Entity\Provenance;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Provenance>
 *
 * @method Provenance|null find($id, $lockMode = null, $lockVersion = null)
 * @method Provenance|null findOneBy(array $criteria, array $orderBy = null)
 * @method Provenance[]    findAll()
 * @method Provenance[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProvenanceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Provenance::class);
    }

    //    /**
    //     * @return Provenance[] Returns an array of Provenance objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Provenance
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
