<?php

namespace App\Repository;

use App\Entity\SuiviUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SuiviUser>
 *
 * @method SuiviUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method SuiviUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method SuiviUser[]    findAll()
 * @method SuiviUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SuiviUserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SuiviUser::class);
    }

    //    /**
    //     * @return SuiviUser[] Returns an array of SuiviUser objects
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

    //    public function findOneBySomeField($value): ?SuiviUser
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
