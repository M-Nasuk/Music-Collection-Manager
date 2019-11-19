<?php


namespace App\Gateway;

use App\Entity\Playlist;
use App\Repository\PlaylistRepository;

/**
 * Class PlaylistGateway
 * @package App\Gateway
 */
class PlaylistGateway implements PlaylistGatewayInterface
{
    /**
     * @var PlaylistRepository
     */
    protected $entityManager;

    /**
     * PlaylistGateway constructor.
     * @param PlaylistRepository $playlistRepository
     */
    public function __construct(PlaylistRepository $playlistRepository)
    {
        $this->entityManager = $playlistRepository;
    }


    /**
     * @param string $name
     * @return Playlist
     */
    public function findPlaylist(string $name): Playlist
    {
        return $this->entityManager->findPlaylistByName($name);
    }

    /**
     * @return PlaylistRepository
     */
    public function getEntityManager(): PlaylistRepository
    {
        return $this->entityManager;
    }

}
