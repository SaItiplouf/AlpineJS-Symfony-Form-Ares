<?php

namespace App\Repository;

use App\Entity\IntituleTechnique;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<IntituleTechnique>
 *
 * @method IntituleTechnique|null find($id, $lockMode = null, $lockVersion = null)
 * @method IntituleTechnique|null findOneBy(array $criteria, array $orderBy = null)
 * @method IntituleTechnique[]    findAll()
 * @method IntituleTechnique[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IntituleTechniqueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IntituleTechnique::class);
    }

    //    /**
    //     * @return IntituleTechnique[] Returns an array of IntituleTechnique objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('i')
    //            ->andWhere('i.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('i.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?IntituleTechnique
    //    {
    //        return $this->createQueryBuilder('i')
    //            ->andWhere('i.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
