<?php

namespace App\Repository;

use App\Entity\SuiviSession;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SuiviSession>
 *
 * @method SuiviSession|null find($id, $lockMode = null, $lockVersion = null)
 * @method SuiviSession|null findOneBy(array $criteria, array $orderBy = null)
 * @method SuiviSession[]    findAll()
 * @method SuiviSession[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SuiviSessionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SuiviSession::class);
    }

    //    /**
    //     * @return SuiviSession[] Returns an array of SuiviSession objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('s.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?SuiviSession
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
