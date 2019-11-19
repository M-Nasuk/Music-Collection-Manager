<?php


namespace App\Service;


use App\Entity\File;
use App\Service\Extractors\ExtractorInterface;

/**
 * Interface ExtractManagerInterface
 * @package App\Service
 */
interface ExtractManagerInterface
{
    /**
     * @param array $criteria
     * @return File
     */
    public function generateFile(array $criteria): File;

    /**
     * @param ExtractorInterface $extractor
     * @return mixed
     */
    public function addExtractor(ExtractorInterface $extractor);


}