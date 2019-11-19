<?php

namespace App\Tests\Repository;

use App\Entity\MediaAlbum;
use App\Entity\Track;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Class TrackRepositoryTest
 * @package App\Tests\Repository
 */
class TrackRepositoryTest extends KernelTestCase
{
    /**
     * @var ObjectManager|object
     */
    protected $entityManager;

    /**
     *
     */
    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    /**
     *
     */
    public function testfindXRandomTracks()
    {
        // PREPARE
        $value = 5;

        // RUN
        $result = $this->entityManager
            ->getRepository(Track::class)
            ->findXRandomTracks($value);

        // ASSERT
        $this->assertIsArray($result);
        $this->assertCount(5, $result);
        $this->assertStringContainsString('Track', $result[0]['title']);

    }

    /**
     *
     */
    public function testFindXRandomTracksByDuration()
    {
        // PREPARE
        $value = 5000;

        // RUN
        $result = $this->entityManager
            ->getRepository(Track::class)
            ->findXRandomTracksByDuration($value);

        $a = 0;

        foreach ($result as $track) {
            $a += (int) $track['duration'];
        }

        // ASSERT
        $this->assertIsArray($result);
        $this->assertLessThan(6000, $a);
        $this->assertGreaterThan(4000, $a);
        $this->assertStringContainsString('Track', $result[0]['title']);
    }

    /**
     *
     */
    public function testFindMedia()
    {
        // PREPARE
        $trackId = 16;

        // RUN
        $result = $this->entityManager
            ->getRepository(Track::class)
            ->findMedia($trackId);

        // ASSERT
        $this->assertIsArray($result);
        $this->assertInstanceOf(MediaAlbum::class, $result[0]);

        // PREPARE
        $trackId_1 = 44;

        // RUN
        $result = $this->entityManager
            ->getRepository(Track::class)
            ->findMedia($trackId_1);

        // ASSERT
        $this->assertEmpty($result);
    }

    /**
     *
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        // doing this is recommended to avoid memory leaks
        $this->entityManager->close();
        $this->entityManager = null;
    }


}