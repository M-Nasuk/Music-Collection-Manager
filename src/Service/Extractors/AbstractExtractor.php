<?php


namespace App\Service\Extractors;


use App\Entity\File;
use App\Service\ExtractorManagerException;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class Extractor
 * @package App\Service\Extractors
 */
abstract class AbstractExtractor implements ExtractorInterface
{
    /**
     * @var ObjectManager
     */
    protected $entityManager;

    protected $format;

    /**
     * Extractor constructor.
     */
    public function __construct()
    {

    }

    /**
     * @return mixed
     */
    public function getFormat()
    {
        return $this->format;
    }


    /**
     * @param array $criteria
     * @return File
     * @throws ExtractorManagerException
     */
    public function extract(array $criteria): File
    {
        if (!$this->doesHandle($criteria)) {
            throw new ExtractorManagerException('Not the right extractor, pick another one.');
        }


        $file = new File();
        $file->setFormat($this->getFormat());
        switch (true) {
            case !empty($criteria['data']['playlist']):
                $this->extractFromPlaylist($criteria['data']['playlist'], $file);
                break;
            case !empty($criteria['data']['album']):
                $this->extractFromAlbum($criteria['data']['album'], $file);
                break;
            case !empty($criteria['data']['compilation']):
                $this->extractFromCompilation($criteria['data']['compilation'], $file);
                break;
        }
//        $this->entityManager->persist($file);
//        $this->entityManager->flush();


        return $file;
    }
}