<?php


namespace App\Service;


use App\Entity\Playlist;
use App\Entity\PlaylistAlbum;
use App\Entity\PlaylistTrack;
use App\Gateway\GatewayInterface;

/**
 * Class Manager
 * @package App\Service
 */
class Manager implements ManagerInterface
{
    use DurationConverter;


    /**
     * @var GatewayInterface
     */
    protected $gateway;

    /**
     * Manager constructor.
     * @param GatewayInterface $gateway
     */
    public function __construct(GatewayInterface $gateway)
    {
        $this->gateway = $gateway;
    }


    /**
     * @param $x int
     * @param null $flag
     * @return Playlist|null
     */
    public function trackPlaylistProvider($x, $flag = null): ?Playlist
    {
        switch (!true) {
            case is_int($x) | is_string($x):
                return null;
                break;
        }

        $choice = $flag;

        switch ($choice){
            case 'Track':
                $tracks = $this->gateway->randomTracksProvider($x);
                break;
            case 'Duration':
                $seconds = $this->convertDurationToSeconds($x);
                $tracks = $this->gateway->randomTracksByDurationProvider($seconds);
                break;
            default;
        }

        $playlist = new Playlist();

        foreach ($tracks as $track) {
            $playlistTrack = new PlaylistTrack();
            $playlistTrack->setTrack($track);
            $playlist->addPlaylistTrack($playlistTrack);
        }

        return $playlist;

    }


    /**
     * @param int $x
     * @param null $flag
     * @return Playlist|null
     */
    public function albumPlaylistProvider(int $x, $flag = null): ?Playlist
    {
        $albums = $this->gateway->randomAlbumProvider($x);

        $playlist = new Playlist();

        foreach ($albums as $album) {
            $playlistAlbum = new PlaylistAlbum();
            $playlistAlbum->setAlbum($album);
            $playlist->addPlaylistAlbum($playlistAlbum);
        }

        return $playlist;
    }


}