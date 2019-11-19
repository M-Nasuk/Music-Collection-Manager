<?php


namespace App\Gateway;


use App\Repository\AlbumRepository;

/**
 * Class AlbumGateway
 * @package App\Gateway
 */
class AlbumGateway implements AlbumGatewayInterface
{

    /**
     * @var AlbumRepository
     */
    protected $entityManager;

    /**
     * AlbumGateway constructor.
     * @param AlbumRepository $albumRepository
     */
    public function __construct(AlbumRepository $albumRepository)
    {
        $this->entityManager = $albumRepository;
    }




    /**
     * @param int $x
     * @return array
     */
    public function randomAlbumProvider(int $x): array
    {
        return $this->entityManager->findXRandomAlbums($x);
    }

    /**
     * @return AlbumRepository
     */
    public function getEntityManager(): AlbumRepository
    {
        return $this->entityManager;
    }


}