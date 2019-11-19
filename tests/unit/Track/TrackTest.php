<?php

namespace App\Tests\Track;

use App\Entity\Album;
use App\Entity\Artist;
use App\Entity\PlaylistTrack;
use App\Entity\Track;
use Codeception\PHPUnit\TestCase;

/**
 * Class TrackTest
 * @package App\Tests\Track
 */
class TrackTest extends TestCase
{
    /**
     * Track Entity Unit Test
     */
    public function testTrackConstruct()
    {
        // PREPARE
        $track = new Track();
        $album = new Album();
        $artist = $this->getMockBuilder(Artist::class)
            ->disableOriginalConstructor()
            ->getMock();
        $playlistTrack = $this->getMockBuilder(PlaylistTrack::class)
            ->getMock();

        // RUN
        $track->setTitle('Somewhere');
        $track->setAlbum($album);
        $track->setArtist($artist);
        $track->addPlaylistTrack($playlistTrack);
        $track->setDuration(480);


        // ASSERT
        $this->assertEquals('', $track->getId());
        $this->assertEquals('Somewhere', $track->getTitle());
        $this->assertSame($album, $track->getAlbum());
        $this->assertSame($artist, $track->getArtist());
        $this->assertEquals(480, $track->getDuration());
    }
}