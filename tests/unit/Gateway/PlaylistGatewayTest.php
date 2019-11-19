<?php namespace App\Tests\Gateway;

use App\Entity\Playlist;
use App\Gateway\PlaylistGateway;
use App\Repository\PlaylistRepository;
use Codeception\PHPUnit\TestCase;

/**
 * Class PlaylistGatewayTest
 * @package App\Tests\Gateway
 */
class PlaylistGatewayTest extends TestCase
{

    /**
     *
     */
    public function testFindPlaylist()
    {
        // PREPARE
        $playlistRepository = $this->getMockBuilder(PlaylistRepository::class)
            ->disableOriginalConstructor()
            ->getMock();
        $gateway = new PlaylistGateway($playlistRepository);
        $playlist = new Playlist();
        $playlist->setTitle('Rock');
        $array[] = $playlist;

        // RUN
        $playlistRepository->method('findPlaylistByName')
            ->willReturn($playlist);
        $result = $gateway->findPlaylist('Rock');

        // ASSERT
        $this->assertEquals($playlist, $result);
    }

    /**
     *
     */
    public function testGetEntityManager()
    {
        // PREPARE
        $playlistRepository = $this->getMockBuilder(PlaylistRepository::class)
            ->disableOriginalConstructor()
            ->getMock();
        $gateway = new PlaylistGateway($playlistRepository);

        // RUN
        $result = $gateway->getEntityManager();

        // ASSERT
        $this->assertEquals($playlistRepository, $result);
    }
}