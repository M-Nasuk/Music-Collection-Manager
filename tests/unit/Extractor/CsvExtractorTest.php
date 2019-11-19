<?php namespace App\Tests\Extractor;

use App\Service\ExtractorManagerException;
use App\Service\Extractors\CsvExtractor;
use Codeception\PHPUnit\TestCase;

/**
 * Class CsvExtractorTest
 * @package App\Tests\Extractor
 */
class CsvExtractorTest extends TestCase
{

    /**
     *
     */
    public function testDoesHandle()
    {
        // PREPARE
        $extractor = new CsvExtractor();
        $criteria = ['csv' => true];

        // RUN
        $result = $extractor->doesHandle($criteria);
        $result1 = $extractor->doesHandle(['mp3' => true]);

        // ASSERT
        $this->assertTrue($result);
        $this->assertFalse($result1);
    }

    /**
     * @throws ExtractorManagerException
     */
    public function testExtract()
    {
        // ASSERT
        $this->expectException(ExtractorManagerException::class);
        $this->expectExceptionMessage('Not the right extractor, pick another one.');


        // PREPARE
        $extractor = new CsvExtractor();
        $criteria = ['xls' => true];

        // RUN
        $extractor->extract($criteria);

    }

}