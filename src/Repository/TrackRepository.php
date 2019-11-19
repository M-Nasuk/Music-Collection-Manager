<?php

namespace App\Repository;

use App\Entity\Album;
use App\Entity\Compilation;
use App\Entity\MediaAlbum;
use App\Entity\MediaCompilation;
use App\Entity\Track;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\Expr\Join;
use PDO;

/**
 * @method Track|null find($id, $lockMode = null, $lockVersion = null)
 * @method Track|null findOneBy(array $criteria, array $orderBy = null)
 * @method Track[]    findAll()
 * @method Track[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TrackRepository extends ServiceEntityRepository
{
    /**
     * TrackRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Track::class);
    }

    /**
     * @param $value
     * @return mixed
     * @throws \Doctrine\DBAL\DBALException
     */
    public function findXRandomTracks(int $value)
    {
        $rawSql = 'SELECT * FROM Track ORDER BY RAND() LIMIT :value';

        $stmt = $this->getEntityManager()->getConnection()->prepare($rawSql);
        $stmt->bindValue(':value', $value, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    /**
     * @param int $duration
     * @return mixed[]
     * @throws \Doctrine\DBAL\DBALException
     */
    public function findXRandomTracksByDuration(int $duration)
    {
        $rawSql = "call getTrackByDuration($duration)";

        $stmt = $this->getEntityManager()->getConnection()->prepare($rawSql);
        $stmt->execute([]);

        return $stmt->fetchAll();

    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findMedia(int $id): array
    {
        return $this->createQueryBuilder('t')
            ->select('ma, mc')
            ->join(Album::class, 'a', JOIN::WITH, 'a.id = t.album')
            ->join(MediaAlbum::class, 'ma', JOIN::WITH, 'ma.album = a.id')
            ->join(Compilation::class, 'c', JOIN::WITH, 'c.id = t.compilation')
            ->join(MediaCompilation::class, 'mc', JOIN::WITH, 'c.id = mc.compilation')
            ->where('t.id = :tid')
            ->setParameters([
                'tid' => $id
            ])
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return Track[] Returns an array of Track objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Track
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
