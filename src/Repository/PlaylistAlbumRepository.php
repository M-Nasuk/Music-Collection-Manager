<?php

namespace App\Repository;

use App\Entity\PlaylistAlbum;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method PlaylistAlbum|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlaylistAlbum|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlaylistAlbum[]    findAll()
 * @method PlaylistAlbum[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlaylistAlbumRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlaylistAlbum::class);
    }

    // /**
    //  * @return PlaylistAlbum[] Returns an array of PlaylistAlbum objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PlaylistAlbum
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
