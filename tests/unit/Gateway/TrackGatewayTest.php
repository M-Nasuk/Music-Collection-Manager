<?php

namespace App\Tests\Gateway;

use App\Entity\Track;
use App\Gateway\TrackGateway;
use App\Repository\TrackRepository;
use Codeception\PHPUnit\TestCase;

/**
 * Class TrackGatewayTest
 * @package App\Tests\Gateway
 */
class TrackGatewayTest extends TestCase
{
    /**
     *
     */
    public function testRandomTracksProvider()
    {
        // PREPARE
        $trackRepository = $this->getMockBuilder(TrackRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        for($i = 0; $i < 5; $i++) {
            $array[$i] = new Track();
        }

        /** @var TrackGateway $gateway */
        $gateway = new TrackGateway($trackRepository);


        // RUN
        $trackRepository->method('findXRandomTracks')
            ->willReturn($array);

        // ASSERT
        $this->assertSame($array, $gateway->randomTracksProvider());
        $this->assertEquals($array[0], $gateway->randomTracksProvider()[3]);
    }

    /**
     *
     */
    public function testRandomTracksByDurationProvider()
    {
        // PREPARE
        $trackRepository = $this->getMockBuilder(TrackRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        for($i = 0; $i < 5; $i++) {
            $array[$i] = new Track();
        }

        /** @var TrackGateway $gateway */
        $gateway = new TrackGateway($trackRepository);


        // RUN
        $trackRepository->method('findXRandomTracksByDuration')
            ->willReturn($array);

        // ASSERT
        $this->assertSame($array, $gateway->randomTracksByDurationProvider());
        $this->assertEquals($array[0], $gateway->randomTracksByDurationProvider()[3]);
    }
}