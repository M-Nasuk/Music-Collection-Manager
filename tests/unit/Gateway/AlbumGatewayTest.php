<?php

namespace App\Tests\Gateway;

use App\Entity\Album;
use App\Gateway\AlbumGateway;
use App\Repository\AlbumRepository;
use Codeception\PHPUnit\TestCase;

/**
 * Class AlbumGatewayTest
 * @package App\Tests\Gateway
 */
class AlbumGatewayTest extends TestCase
{
    /**
     *
     */
    public function testRandomAlbumProvider()
    {
        // PREPARE
        $albumRepository = $this->getMockBuilder(AlbumRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        for($i = 0; $i < 5; $i++) {
            $array[$i] = new Album();
        }

        $gateway = new AlbumGateway($albumRepository);

        // RUN
        $albumRepository->method('findXRandomAlbums')
            ->willReturn($array);

        // ASSERT
        $this->assertSame($array, $gateway->randomAlbumProvider(5));
    }


    /**
     *
     */
    public function testGetEntityManager()
    {
        // PREPARE
        $albumRepository = $this->getMockBuilder(AlbumRepository::class)
            ->disableOriginalConstructor()
            ->getMock();
        $gateway = new AlbumGateway($albumRepository);

        // RUN
        $result = $gateway->getEntityManager();

        // ASSERT
        $this->assertEquals($albumRepository, $result);
    }
}