<?php

namespace App\Repository;

use App\Entity\PageSynthese;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PageSynthese>
 *
 * @method PageSynthese|null find($id, $lockMode = null, $lockVersion = null)
 * @method PageSynthese|null findOneBy(array $criteria, array $orderBy = null)
 * @method PageSynthese[]    findAll()
 * @method PageSynthese[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PageSyntheseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PageSynthese::class);
    }

    //    /**
    //     * @return PageSynthese[] Returns an array of PageSynthese objects
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

    //    public function findOneBySomeField($value): ?PageSynthese
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
