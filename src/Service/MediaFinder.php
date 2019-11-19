<?php


namespace App\Service;


use App\Entity\MediaAlbum;
use App\Entity\MediaCompilation;
use App\Gateway\GatewayInterface;
use ReflectionException;

/**
 * Class MediaFinder
 * @package App\Service
 */
class MediaFinder implements MediaFinderInterface
{
    /**
     * @var
     */
    protected $media;

    /**
     * @var GatewayInterface
     */
    protected $gateway;

    /**
     * MediaFinder constructor.
     * @param GatewayInterface $gateway
     */
    public function __construct(GatewayInterface $gateway)
    {
        $this->gateway = $gateway;
    }


    /**
     * @param int $id
     * @return mixed
     * @throws ReflectionException
     */
    public function findMedia(int $id): array
    {
        $result = $this->gateway->getMedia($id);
        if (!empty($result)) {
            if ($result[0] instanceof MediaAlbum) {
                $array['album'] = $result[0]->getMedia();
                if (!empty($result[1]) && $result[1] instanceof MediaCompilation) {
                    $array['compilation'] = $result[1]->getMedia();
                }
            } else {
                $array['compilation'] = $result[0]->getMedia();
            }
        }
        return $array;
    }
}