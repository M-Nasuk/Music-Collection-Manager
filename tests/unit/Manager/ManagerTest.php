<?php namespace App\Tests\Manager;


use App\Entity\Album;
use App\Entity\Playlist;
use App\Entity\PlaylistAlbum;
use App\Entity\PlaylistTrack;
use App\Entity\Track;
use App\Gateway\AlbumGateway;
use App\Gateway\TrackGateway;
use App\Service\Manager;
use Codeception\PHPUnit\TestCase;

/**
 * Class ManagerTest
 * @package App\Tests\Manager
 */
class ManagerTest extends TestCase
{

    /**
     *
     */
    public function testTrackPlaylistProvider()
    {
        // PREPARE
        /** @var TrackGateway $trackGateway */
        $trackGateway = $this->getMockBuilder(TrackGateway::class)
            ->disableOriginalConstructor()
            ->getMock();
        $trackGateway1 = $this->getMockBuilder(TrackGateway::class)
            ->disableOriginalConstructor()
            ->getMock();
        /** @var Manager $manager */
        $manager = new Manager($trackGateway);
        $manager1 = new Manager($trackGateway);
        /** @var Track $track */
        $track = new Track();
        /** @var Playlist $playlist */
        $playlist = new Playlist();
        $playlist1 = new Playlist();
        /** @var PlaylistTrack $playlistTrack */
        $playlistTrack = new PlaylistTrack();

        for($i = 0; $i < 5; $i++) {
            $array[$i] = new Track();
            $playlistTrack = new PlaylistTrack();
            $playlistTrack->setTrack($track);
            $playlist->addPlaylistTrack($playlistTrack);
        }


        // RUN
        /**
         * By Number of Tracks
         */
        $trackGateway->method('randomTracksProvider')
            ->willReturn($array);
        $result = $manager->TrackPlaylistProvider(5, 'Track');

        /**
         * By Duration
         */
        $trackGateway1->method('randomTracksByDurationProvider')
            ->willReturn($array);
        $result1 = $manager1->TrackPlaylistProvider('20 minutes', 'Duration');

        /**
         * Null Case
         */
        $result2 = $manager1->TrackPlaylistProvider(['20 minutes'], 'Duration');



        // ASSERT
        $this->assertIsObject($result);
        $this->assertObjectHasAttribute('title', $result);
        $this->assertEquals($playlist, $result);
        $this->assertEquals($playlistTrack, $result->getPlaylistTracks()[0]);

        $this->assertIsObject($result1);
        $this->assertObjectHasAttribute('title', $result1);
        $this->assertEquals($playlist1, $result1);

        $this->assertEquals(null, $result2);

    }


    /**
     *
     */
    public function testAlbumPlaylistProvider()
    {
        // PREPARE
        $gateway = $this->getMockBuilder(AlbumGateway::class)
            ->disableOriginalConstructor()
            ->getMock();

        $manager = new Manager($gateway);

        $album = new Album();
        $playlist = new Playlist();
        $playlistAlbum = new PlaylistAlbum();

        for($i = 0; $i < 5; $i++) {
            $array[$i] = new Album();
            $playlistAlbum = new PlaylistAlbum();
            $playlistAlbum->setAlbum($album);
            $playlist->addPlaylistAlbum($playlistAlbum);
        }
        // RUN
        $gateway->method('randomAlbumProvider')
            ->willReturn($array);
        $result = $manager->albumPlaylistProvider(5);

        // ASSERT
        $this->assertIsObject($result);
        $this->assertEquals($playlist, $result);
        $this->assertEquals($playlistAlbum, $result->getPlaylistAlbums()[0]);
    }
}