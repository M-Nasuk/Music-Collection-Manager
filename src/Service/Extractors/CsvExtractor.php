<?php


namespace App\Service\Extractors;


use App\Entity\Album;
use App\Entity\Compilation;
use App\Entity\File;
use App\Entity\Playlist;

/**
 * Class CsvExtractor
 * @package App\Service\Extractors
 */
class CsvExtractor extends AbstractExtractor
{
    /**
     * @var string
     */
    protected $format = 'CSV';


    /**
     * @param array $criteria
     * @return bool
     */
    public function doesHandle(array $criteria): bool
    {
        return !empty($criteria['csv']);
    }


    /**
     * @param Playlist $playlist
     * @param File $file
     */
    public function extractFromPlaylist(Playlist $playlist, File $file)
    {
        $file->setName('Playlist_'.$playlist->getTitle());
        $file->setPath('public/extract/csv/playlist/'.$file->getName().'.csv');

        $filepath = fopen('public/extract/csv/playlist/'.$file->getName().'.csv', 'w');


        foreach ($playlist->getPlaylistTracks() as $playlistTrack) {
            fputcsv($filepath, [$playlistTrack->getTrack()->getTitle()]);
        }

        fclose($filepath);
    }

    /**
     * @param Album $album
     * @param File $file
     */
    public function extractFromAlbum(Album $album, File $file)
    {
        $file->setName('Album_'.$album->getTitle());
        $file->setPath('public/extract/csv/album/'.$file->getName().'.csv');

        $filepath = fopen('public/extract/csv/album/'.$file->getName().'.csv', 'w');

        foreach ($album->getTracks() as $track) {
            fputcsv($filepath, [$track->getTitle()]);
        }

        fclose($filepath);
    }

    /**
     * @param Compilation $compilation
     * @param File $file
     */
    public function extractFromCompilation(Compilation $compilation, File $file)
    {
        $file->setName('Compilation_'.$compilation->getTitle());
        $file->setPath('public/extract/csv/compilation/'.$file->getName().'.csv');

        $filepath = fopen('public/extract/csv/compilation/'.$file->getName().'.csv', 'w');


        foreach ($compilation->getTracks() as $track) {
            fputcsv($filepath, [$track->getTitle()]);
        }

        fclose($filepath);
    }
}