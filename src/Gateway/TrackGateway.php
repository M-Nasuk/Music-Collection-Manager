<?php


namespace App\Gateway;


use App\Repository\TrackRepository;

/**
 * Class TrackGateway
 * @package App\Gateway
 */
class TrackGateway implements TrackGatewayInterface
{
    /** @var TrackRepository */
    protected $entityManager;

    /**
     * PlaylistGateway constructor.
     * @param TrackRepository $trackRepository
     */
    public function __construct(TrackRepository $trackRepository)
    {
        $this->entityManager = $trackRepository;
    }

    /**
     * @param int $x
     * @return array
     */
    public function randomTracksProvider(int $x = 0): array
    {
        return $this->entityManager->findXRandomTracks($x);
    }

    /**
     * @param int $x
     * @return array
     * @throws \Doctrine\DBAL\DBALException
     */
    public function randomTracksByDurationProvider(int $x = 0): array
    {
        return $this->entityManager->findXRandomTracksByDuration($x);
    }


    /**
     * @param int $id
     * @return mixed
     */
    public function getMedia(int $id)
    {
        return $this->entityManager->findMedia($id);
    }

}