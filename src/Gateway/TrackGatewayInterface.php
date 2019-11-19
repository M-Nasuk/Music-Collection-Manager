<?php


namespace App\Gateway;


/**
 * Interface TrackGatewayInterface
 * @package App\Gateway
 */
interface TrackGatewayInterface extends GatewayInterface
{
    /**
     * @param int $x
     * @return array
     */
    public function randomTracksProvider(int $x): array;

    /**
     * @param int $x
     * @return array
     */
    public function randomTracksByDurationProvider(int $x):  array ;
}