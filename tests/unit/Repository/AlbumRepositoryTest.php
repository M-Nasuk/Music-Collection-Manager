<?php

namespace App\Tests\Repository;

use App\Entity\Album;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class AlbumRepositoryTest extends KernelTestCase
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
    public function testFindXRandomAlbums()
    {
        // PREPARE
        $value = 5;

        // RUN
        $result = $this->entityManager
            ->getRepository(Album::class)
            ->findXRandomAlbums($value);

        // ASSERT
        $this->assertIsArray($result);
        $this->assertCount(5, $result);
        $this->assertStringContainsString('Album', $result[0]['title']);

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