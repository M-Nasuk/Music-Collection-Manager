<?php

namespace App\Tests\Manager;

use App\Entity\Album;
use App\Entity\Artist;
use App\Entity\Compilation;
use App\Entity\File;
use App\Entity\Playlist;
use App\Entity\PlaylistTrack;
use App\Entity\Track;
use App\Service\ExtractManager;
use App\Service\ExtractorManagerException;
use App\Service\Extractors\CsvExtractor;
use App\Service\Extractors\XlsExtractor;
use Codeception\PHPUnit\TestCase;

/**
 * Class ExtractManagerTest
 * @package App\Tests\Manager
 */
class ExtractManagerTest extends TestCase
{
    /**
     *
     */
    public function testAddExtractor()
    {
        // PREPARE
        $manager = new ExtractManager();
        $csvExtractor = new CsvExtractor();

        // RUN
        $manager->addExtractor($csvExtractor);

        // ASSERT
        $this->assertEquals($csvExtractor, $manager->getExtractors()[0]);
    }

    /**
     * @throws ExtractorManagerException
     */
    public function testGenerateFile()
    {
        // PREPARE
        $csvExtractor = new CsvExtractor();
        $xlsExtractor = new XlsExtractor();
        $extractors = [$csvExtractor, $xlsExtractor];
        $manager = new ExtractManager(...$extractors);

        $file = new File();

        $playlist = new Playlist();
        $playlist->setTitle('House_2019');

        $album = new Album();

        $compilation = new Compilation();

        $artist = new Artist();

        $playlistTrack_1 = new PlaylistTrack();
        $playlistTrack_2 = new PlaylistTrack();

        for($i = 1; $i < 7; $i++) {
            ${"track_$i"} = new Track();
        }

        $track_1->setId(1)->setTitle('First')->setAlbum($album)->setArtist($artist)->setDuration(400);
        $track_2->setId(2)->setTitle('Second')->setAlbum($album)->setArtist($artist)->setDuration(200);
        $track_3->setId(3)->setTitle('Third')->setAlbum($album)->setArtist($artist)->setDuration(490);
        $track_4->setId(4)->setTitle('Fourth')->setAlbum($album)->setArtist($artist)->setDuration(440);
        $track_5->setId(5)->setTitle('Fifth')->setAlbum($album)->setArtist($artist)->setDuration(360);
        $track_6->setId(6)->setTitle('Sixth')->setAlbum($album)->setArtist($artist)->setDuration(500);

        $artist->setName('LP');
        $album->setTitle('Jovie')->addTrack($track_3)->addTrack($track_4)->setArtist($artist);
        $compilation->setTitle('Coco')->addTrack($track_5)->addTrack($track_6);

        $playlistTrack_1->setTrack($track_1)->setPlaylist($playlist);
        $playlistTrack_2->setTrack($track_2)->setPlaylist($playlist);

        $playlist->addPlaylistTrack($playlistTrack_1)->addPlaylistTrack($playlistTrack_2);

        // CSV File
        $criteriaCsvPlaylist = ['csv' => true, 'data' => ['playlist' => $playlist]];
        $criteriaCsvAlbum = ['csv' => true, 'data' => ['album' => $album]];
        $criteriaCsvCompilation = ['csv' => true, 'data' => ['compilation' => $compilation]];

        // XLS File
        $criteriaXlsPlaylist = ['xls' => true, 'data' => ['playlist' => $playlist]];
        $criteriaXlsAlbum = ['xls' => true, 'data' => ['album' => $album]];
        $criteriaXlsCompilation = ['xls' => true, 'data' => ['compilation' => $compilation]];

        $file->setName('Playlist_House_2019')
            ->setPath('public/extract/csv/playlist/Playlist_House_2019.csv')
            ->setFormat('CSV');

        // RUN
        $resultCsvPlaylist = $manager->generateFile($criteriaCsvPlaylist);
        $resultCsvAlbum = $manager->generateFile($criteriaCsvAlbum);
        $resultCsvCompilation = $manager->generateFile($criteriaCsvCompilation);

        $resultXlsPlaylist = $manager->generateFile($criteriaXlsPlaylist);
        $resultXlsAlbum = $manager->generateFile($criteriaXlsAlbum);
        $resultXlsCompilation = $manager->generateFile($criteriaXlsCompilation);


        $pathInfoCsv = pathinfo($resultCsvPlaylist->getPath());
        $extensionCsv = $pathInfoCsv['extension'];

        $pathInfoXls = pathinfo($resultXlsPlaylist->getPath());
        $extensionXls = $pathInfoXls['extension'];

        $fpPlaylist = fopen($resultCsvPlaylist->getPath(), 'r');
        $fpAlbum = fopen($resultCsvAlbum->getPath(), 'r');
        $fpCompilation = fopen($resultCsvCompilation->getPath(), 'r');

        // ASSERT
        $this->assertEquals($file, $resultCsvPlaylist);

        $this->assertEquals('First', fread($fpPlaylist, 5));
        $this->assertEquals('Third', fread($fpAlbum, 5));
        $this->assertEquals('Fifth', fread($fpCompilation, 5));

        $this->assertEquals('csv', $extensionCsv);
        $this->assertEquals('xls', $extensionXls);

        $this->assertEquals('Album_Jovie', $resultCsvAlbum->getName());
        $this->assertEquals('Compilation_Coco', $resultCsvCompilation->getName());

        $this->assertEquals('Album_Jovie', $resultXlsAlbum->getName());
        $this->assertEquals('Compilation_Coco', $resultXlsCompilation->getName());

        $this->expectException(ExtractorManagerException::class);

        // PREPARE
        $criteriaCsvPlaylist = ['flac' => true, 'data' => ['playlist' => $playlist]];

        // RUN
        $manager->generateFile($criteriaCsvPlaylist);

    }

}