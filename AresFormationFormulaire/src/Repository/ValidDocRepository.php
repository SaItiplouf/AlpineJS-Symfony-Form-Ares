<?php

namespace App\Repository;

use App\Entity\ValidDoc;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ValidDoc>
 *
 * @method ValidDoc|null find($id, $lockMode = null, $lockVersion = null)
 * @method ValidDoc|null findOneBy(array $criteria, array $orderBy = null)
 * @method ValidDoc[]    findAll()
 * @method ValidDoc[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ValidDocRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ValidDoc::class);
    }

    //    /**
    //     * @return ValidDoc[] Returns an array of ValidDoc objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('v')
    //            ->andWhere('v.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('v.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?ValidDoc
    //    {
    //        return $this->createQueryBuilder('v')
    //            ->andWhere('v.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
