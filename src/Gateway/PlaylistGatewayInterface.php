<?php


namespace App\Gateway;


use App\Entity\Playlist;

/**
 * Interface PlaylistGatewayInterface
 * @package App\Gateway
 */
interface PlaylistGatewayInterface extends GatewayInterface
{
    /**
     * @param string $name
     * @return Playlist
     */
    public function findPlaylist(string $name): Playlist;
}