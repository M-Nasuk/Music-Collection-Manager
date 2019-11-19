<?php


namespace App\Service;


use DateInterval;
use DateTime;
use Exception;

/**
 * Trait DurationConverter
 * @package App\Service
 */
trait DurationConverter
{
    /**
     * @param string $duration
     * @return int
     */
    public function convertDurationToSeconds(string $duration): int
    {
        $interval = DateInterval::createFromDateString($duration);
        $format = $interval->format('%H:%I:%S');
        sscanf($format, '%d:%d:%d', $hours, $minutes, $seconds);

        return (($hours * 60) + $minutes )  * 60 + $seconds;
    }

    /**
     * @param int $seconds
     * @return string
     * @throws Exception
     */
    public function convertSecondsToDuration(int $seconds): string
    {
        $dtF = new DateTime('@0');
        $dtT = new DateTime("@$seconds");
        switch (true) {
            case $seconds < 2:
                $format = '%s second';
                break;
            case $seconds < 60:
                $format = '%s seconds';
                break;
            case $seconds < 120:
                $format = '%i minute %s seconds';
                break;
            case $seconds < 3600:
                $format = '%i minutes %s seconds';
                break;
            case $seconds < 7200:
                $format = '%h hour %i minutes %s seconds';
                break;
            default:
                $format = '%h hours %i minutes %s seconds';
        }
        return $dtF->diff($dtT)->format($format);
    }
}