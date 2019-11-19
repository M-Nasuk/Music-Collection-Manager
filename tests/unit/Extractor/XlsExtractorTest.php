<?php namespace App\Tests\Extractor;

use App\Service\ExtractorManagerException;
use App\Service\Extractors\XlsExtractor;
use Codeception\PHPUnit\TestCase;

/**
 * Class XlsExtractorTest
 * @package App\Tests\Extractor
 */
class XlsExtractorTest extends TestCase
{
    /**
     *
     */
    public function testDoesHandle()
    {
        // PREPARE
        $extractor = new XlsExtractor();
        $criteria = ['xls' => true];

        // RUN
        $result = $extractor->doesHandle($criteria);
        $result1 = $extractor->doesHandle(['csv' => true]);

        // ASSERT
        $this->assertTrue($result);
        $this->assertFalse($result1);
    }

    /**
     * @throws ExtractorManagerException
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function testExceptionGenerateFile()
    {
        // PREPARE
        $criteria = ['flac' => true];

        // ASSERT
        $extractor = new XlsExtractor();
        $this->expectException(ExtractorManagerException::class);

        // RUN
        $extractor->extract($criteria);

    }
}