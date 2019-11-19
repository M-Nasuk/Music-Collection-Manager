<?php


namespace App\Service;


use App\Entity\File;
use App\Service\Extractors\ExtractorInterface;

/**
 * Class ExtractManager
 * @package App\Service
 */
class ExtractManager implements ExtractManagerInterface
{
    /** @var ExtractorInterface[] */
    protected $extractors = [];

    /**
     * ExtractManager constructor.
     * @param ExtractorInterface[] $extractors
     */
    public function __construct(ExtractorInterface ...$extractors)
    {
        foreach ($extractors as $extractor) {
            $this->addExtractor($extractor);
        }
    }

    /**
     * @return ExtractorInterface[]
     */
    public function getExtractors(): array
    {
        return $this->extractors;
    }


    /**
     * @param array $criteria
     * @return File
     * @throws ExtractorManagerException
     */
    public function generateFile(array $criteria): File
    {
        foreach ($this->extractors as $extractor)
        {
            if ($extractor->doesHandle($criteria)) {
                return $extractor->extract($criteria);
            }
        }

        throw new ExtractorManagerException('No extractor found to handle given format.');

    }

    /**
     * @param ExtractorInterface $extractor
     */
    public function addExtractor(ExtractorInterface $extractor)
    {
        $this->extractors[] = $extractor;
    }


}