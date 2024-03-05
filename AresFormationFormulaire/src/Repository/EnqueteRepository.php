<?php

namespace App\Repository;

use App\Entity\Enquete;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Enquete>
 *
 * @method Enquete|null find($id, $lockMode = null, $lockVersion = null)
 * @method Enquete|null findOneBy(array $criteria, array $orderBy = null)
 * @method Enquete[]    findAll()
 * @method Enquete[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EnqueteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Enquete::class);
    }

    //    /**
    //     * @return Enquete[] Returns an array of Enquete objects
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

    //    public function findOneBySomeField($value): ?Enquete
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
