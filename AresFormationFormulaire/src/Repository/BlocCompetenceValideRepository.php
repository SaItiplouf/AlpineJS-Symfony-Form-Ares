<?php

namespace App\Repository;

use App\Entity\BlocCompetenceValide;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BlocCompetenceValide>
 *
 * @method BlocCompetenceValide|null find($id, $lockMode = null, $lockVersion = null)
 * @method BlocCompetenceValide|null findOneBy(array $criteria, array $orderBy = null)
 * @method BlocCompetenceValide[]    findAll()
 * @method BlocCompetenceValide[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BlocCompetenceValideRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BlocCompetenceValide::class);
    }

    //    /**
    //     * @return BlocCompetenceValide[] Returns an array of BlocCompetenceValide objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('b.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?BlocCompetenceValide
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
