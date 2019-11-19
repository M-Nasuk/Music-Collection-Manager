<?php

namespace App\Repository;

use App\Entity\MediaCompilation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method MediaCompilation|null find($id, $lockMode = null, $lockVersion = null)
 * @method MediaCompilation|null findOneBy(array $criteria, array $orderBy = null)
 * @method MediaCompilation[]    findAll()
 * @method MediaCompilation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MediaCompilationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MediaCompilation::class);
    }

    // /**
    //  * @return MediaCompilation[] Returns an array of MediaCompilation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MediaCompilation
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
