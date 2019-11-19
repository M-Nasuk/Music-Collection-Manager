<?php

namespace App\Tests\Traits;

use Codeception\PHPUnit\TestCase;
use App\Service\DurationConverter;


/**
 * Class DurationConverterTest
 * @package App\Tests\Traits
 */
class DurationConverterTest extends TestCase
{

    /**
     *
     */
    public function testConvertDuration()
    {
        // PREPARE
        $class = new class { use DurationConverter; };

        // RUN
        $result = $class->convertDurationToSeconds('1 hour');
        $result_1 = $class->convertSecondsToDuration(1);
        $result_2 = $class->convertSecondsToDuration(42);
        $result_3 = $class->convertSecondsToDuration(72);
        $result_4 = $class->convertSecondsToDuration(3600);
        $result_5 = $class->convertSecondsToDuration(7200);


        // ASSERT
        $this->assertEquals(3600, $result);
        $this->assertEquals('1 second', $result_1);
        $this->assertEquals('42 seconds', $result_2);
        $this->assertEquals('1 minute 12 seconds', $result_3);
        $this->assertEquals('1 hour 0 minutes 0 seconds', $result_4);
        $this->assertEquals('2 hours 0 minutes 0 seconds', $result_5);
    }
}