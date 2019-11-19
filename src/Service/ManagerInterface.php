<?php


namespace App\Service;


use App\Entity\Playlist;

/**
 * Interface ManagerInterface
 * @package App\Service
 */
interface ManagerInterface
{

    /**
     * @param int $x
     * @param null $flag
     * @return Playlist|null
     */
    public function TrackPlaylistProvider($x, $flag = null): ?Playlist;


    /**
     * @param int $x
     * @return Playlist|null
     */
    public function AlbumPlaylistProvider(int $x): ?Playlist;
}