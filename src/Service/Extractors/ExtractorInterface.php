<?php


namespace App\Service\Extractors;


use App\Entity\Album;
use App\Entity\Compilation;
use App\Entity\File;
use App\Entity\Playlist;

/**
 * Interface ExtractorInterface
 * @package App\Service\Extractors
 */
interface ExtractorInterface
{
    /**
     * @param array $criteria
     * @return bool
     */
    public function doesHandle(array $criteria): bool;

    /**
     * @param array $criteria
     * @return File
     */
    public function extract(array $criteria): File;

    /**
     * @param Playlist $playlist
     * @param File $file
     * @return mixed
     */
    public function extractFromPlaylist(Playlist $playlist, File $file);

    /**
     * @param Album $album
     * @param File $file
     * @return mixed
     */
    public function extractFromAlbum(Album $album, File $file);

    /**
     * @param Compilation $compilation
     * @param File $file
     * @return mixed
     */
    public function extractFromCompilation(Compilation $compilation, File $file);

}