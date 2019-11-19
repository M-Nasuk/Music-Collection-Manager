<?php


namespace App\Entity;


use ReflectionClass;

/**
 * Class AbstractMedia
 * @package App\Entity
 */
class AbstractMedia
{

    /**
     * @return array|null
     * @throws \ReflectionException
     */
    public function getMedia()
    {
        $media = null;

        if (!empty($this->getVinyle())) {
            $media[] = (new ReflectionClass($this->getVinyle()))->getShortName();
        }

        if (!empty($this->getDisk())) {
            $media[] = (new ReflectionClass($this->getDisk()))->getShortName();
        }

        return $media;
    }
}