<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DiskRepository")
 */
class Disk extends Media
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MediaAlbum", mappedBy="disk")
     */
    protected $mediaAlbums;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MediaCompilation", mappedBy="disk")
     */
    protected $mediaCompilations;

    public function __construct()
    {
        $this->mediaAlbums = new ArrayCollection();
        $this->mediaCompilations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|MediaAlbum[]
     */
    public function getMediaAlbums(): Collection
    {
        return $this->mediaAlbums;
    }

    public function addMediaAlbum(MediaAlbum $mediaAlbum): self
    {
        if (!$this->mediaAlbums->contains($mediaAlbum)) {
            $this->mediaAlbums[] = $mediaAlbum;
            $mediaAlbum->setDisk($this);
        }

        return $this;
    }

    public function removeMediaAlbum(MediaAlbum $mediaAlbum): self
    {
        if ($this->mediaAlbums->contains($mediaAlbum)) {
            $this->mediaAlbums->removeElement($mediaAlbum);
            // set the owning side to null (unless already changed)
            if ($mediaAlbum->getDisk() === $this) {
                $mediaAlbum->setDisk(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|MediaCompilation[]
     */
    public function getMediaCompilations(): Collection
    {
        return $this->mediaCompilations;
    }

    public function addMediaCompilation(MediaCompilation $mediaCompilation): self
    {
        if (!$this->mediaCompilations->contains($mediaCompilation)) {
            $this->mediaCompilations[] = $mediaCompilation;
            $mediaCompilation->setDisk($this);
        }

        return $this;
    }

    public function removeMediaCompilation(MediaCompilation $mediaCompilation): self
    {
        if ($this->mediaCompilations->contains($mediaCompilation)) {
            $this->mediaCompilations->removeElement($mediaCompilation);
            // set the owning side to null (unless already changed)
            if ($mediaCompilation->getDisk() === $this) {
                $mediaCompilation->setDisk(null);
            }
        }

        return $this;
    }


}
