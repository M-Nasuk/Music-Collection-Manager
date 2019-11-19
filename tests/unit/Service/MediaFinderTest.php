<?php namespace App\Tests\Service;

use App\Entity\Album;
use App\Entity\Compilation;
use App\Entity\Disk;
use App\Entity\MediaAlbum;
use App\Entity\MediaCompilation;
use App\Entity\Track;
use App\Entity\Vinyle;
use App\Gateway\TrackGateway;
use App\Repository\TrackRepository;
use App\Service\MediaFinder;
use Codeception\PHPUnit\TestCase;

/**
 * Class MediaFinderTest
 * @package App\Tests\Service
 */
class MediaFinderTest extends TestCase
{
    /**
     * @throws \ReflectionException
     */
    public function testFindMedia()
    {
        // PREPARE
        $trackRepository = $this->getMockBuilder(TrackRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $gateway = new TrackGateway($trackRepository);

        $mediaFinder = new MediaFinder($gateway);

        $album = new Album();
        $album->setTitle('Album_1')->setId(2);

        $disk = new Disk();
        $vinyle = new Vinyle();

        $mediaAlbum = new MediaAlbum();
        $mediaAlbum->setAlbum($album)->setDisk($disk);

        $album->setMediaAlbum($mediaAlbum);

        $compilation = new Compilation();
        $compilation->setTitle('Comp');

        $mediaCompilation = new MediaCompilation();
        $mediaCompilation->setVinyle($vinyle)->setCompilation($compilation);

        $compilation->setMediaCompilation($mediaCompilation);



        $track = new Track();
        $track->setTitle('Jojo')->setId(12)->setAlbum($album)->setCompilation($compilation);

        $album->addTrack($track);
        $compilation->addTrack($track);

        $queryResult = [
            $track->getAlbum()->getMediaAlbum(),
            $track->getCompilation()->getMediaCompilation()
        ];

        // RUN
        $trackRepository->method('findMedia')
            ->willReturn($queryResult);

        $result = $mediaFinder->findMedia($track->getId());


        // ASSERT
        $this->assertIsArray($result);
        $this->assertEquals('Disk', $result['album'][0]);
        $this->assertEquals('Vinyle', $result['compilation'][0]);


    }

    /**
     * @throws \ReflectionException
     */
    public function testFindMediaOnlyCompilation()
    {
        // PREPARE
        $trackRepository = $this->getMockBuilder(TrackRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $gateway = new TrackGateway($trackRepository);

        $mediaFinder = new MediaFinder($gateway);

        $disk = new Disk();
        $vinyle = new Vinyle();


        $compilation = new Compilation();
        $compilation->setTitle('Comp');

        $mediaCompilation = new MediaCompilation();
        $mediaCompilation->setDisk($disk)->setVinyle($vinyle)->setCompilation($compilation);

        $compilation->setMediaCompilation($mediaCompilation);

        $track = new Track();

        $track->setTitle('Jojo')->setId(12)->setCompilation($compilation);

        $compilation->addTrack($track);

        $queryResult = [
            $track->getCompilation()->getMediaCompilation()
        ];

        // RUN
        $trackRepository->method('findMedia')
            ->willReturn($queryResult);

        $result = $mediaFinder->findMedia($track->getId());


        // ASSERT
        $this->assertIsArray($result);
        $this->assertEquals('Vinyle', $result['compilation'][0]);
    }
}