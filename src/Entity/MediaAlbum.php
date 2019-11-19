<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MediaAlbumRepository")
 */
class MediaAlbum extends AbstractMedia
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Disk", inversedBy="mediaAlbums")
     */
    protected $disk;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Vinyle", inversedBy="mediaAlbums")
     */
    protected $vinyle;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Album", inversedBy="mediaAlbum", cascade={"persist", "remove"})
     */
    private $album;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDisk(): ?Disk
    {
        return $this->disk;
    }

    public function setDisk(?Disk $disk): self
    {
        $this->disk = $disk;

        return $this;
    }

    public function getVinyle(): ?Vinyle
    {
        return $this->vinyle;
    }

    public function setVinyle(?Vinyle $vinyle): self
    {
        $this->vinyle = $vinyle;

        return $this;
    }
    public function getAlbum(): ?Album
    {
        return $this->album;
    }

    public function setAlbum(?Album $album): self
    {
        $this->album = $album;

        return $this;
    }

}
