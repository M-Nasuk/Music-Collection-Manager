<?php


namespace App\Gateway;


/**
 * Interface AlbumGatewayInterface
 * @package App\Gateway
 */
interface AlbumGatewayInterface extends GatewayInterface
{
    /**
     * @param int $x
     * @return array
     */
    public function randomAlbumProvider(int $x): array ;
}