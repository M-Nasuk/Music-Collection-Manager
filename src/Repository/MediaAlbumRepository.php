<?php

namespace App\Repository;

use App\Entity\MediaAlbum;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method MediaAlbum|null find($id, $lockMode = null, $lockVersion = null)
 * @method MediaAlbum|null findOneBy(array $criteria, array $orderBy = null)
 * @method MediaAlbum[]    findAll()
 * @method MediaAlbum[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MediaAlbumRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MediaAlbum::class);
    }

    // /**
    //  * @return MediaAlbum[] Returns an array of MediaAlbum objects
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
    public function findOneBySomeField($value): ?MediaAlbum
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
