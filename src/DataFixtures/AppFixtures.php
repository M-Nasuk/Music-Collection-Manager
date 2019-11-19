<?php

namespace App\DataFixtures;

use App\Entity\Album;
use App\Entity\Artist;
use App\Entity\Compilation;
use App\Entity\Disk;
use App\Entity\MediaAlbum;
use App\Entity\MediaCompilation;
use App\Entity\Track;
use App\Entity\Vinyle;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class AppFixtures
 * @package App\DataFixtures
 */
class AppFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 20; $i++) {

            // ARTIST
            $artist = new Artist();
            $artist->setName('Artist '.($i+5));
            $artist->setCountry('Country '.$i);

            // ALBUM
            $album = new Album();
            $album->setTitle('Album '.$i);
            $album->setArtist($artist);

            // COMPILATION
            $compilation = new Compilation();
            $compilation->setTitle('Compilation '.($i+10));

            // DISK
            $disk = new Disk();

            // VINYLE
            $vinyle = new Vinyle();


            // MEDIAALBUM
            $mediaAlbum = new MediaAlbum();
            $mediaAlbum->setVinyle($vinyle);
            $mediaAlbum->setDisk($disk);

            // MEDIACOMPILATION
            $mediaCompilation = new MediaCompilation();
            $mediaCompilation->setVinyle($vinyle);
            $mediaCompilation->setDisk($disk);

            // ALBUM / COMPILATION
            $album->setMediaAlbum($mediaAlbum);
            $compilation->setMediaCompilation($mediaCompilation);

            // TRACK
            $track = new Track();
            $track->setTitle('Track '.$i);
            $track->setAlbum($album)->setCompilation($compilation);
            $track->setArtist($album->getArtist());
            $track->setDuration(floor(rand(200, 600)));

            // PERSIST
            $manager->persist($artist);
            $manager->persist($album);
            $manager->persist($compilation);
            $manager->persist($disk);
            $manager->persist($vinyle);
            $manager->persist($mediaAlbum);
            $manager->persist($mediaCompilation);
            $manager->persist($track);

        }


            $manager->flush();
    }
}
