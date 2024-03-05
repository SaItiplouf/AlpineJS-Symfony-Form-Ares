<?php

namespace App\Repository;

use App\Entity\EnqueteReponse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EnqueteReponse>
 *
 * @method EnqueteReponse|null find($id, $lockMode = null, $lockVersion = null)
 * @method EnqueteReponse|null findOneBy(array $criteria, array $orderBy = null)
 * @method EnqueteReponse[]    findAll()
 * @method EnqueteReponse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EnqueteReponseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EnqueteReponse::class);
    }

    //    /**
    //     * @return EnqueteReponse[] Returns an array of EnqueteReponse objects
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

    //    public function findOneBySomeField($value): ?EnqueteReponse
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
