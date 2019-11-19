<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FileRepository")
 */
class File
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MediaAlbum", mappedBy="file")
     */
    protected $mediaAlbums;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MediaCompilation", mappedBy="file")
     */
    protected $mediaCompilations;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $format;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $path;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;


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
            $mediaAlbum->setFile($this);
        }

        return $this;
    }

    public function removeMediaAlbum(MediaAlbum $mediaAlbum): self
    {
        if ($this->mediaAlbums->contains($mediaAlbum)) {
            $this->mediaAlbums->removeElement($mediaAlbum);
            // set the owning side to null (unless already changed)
            if ($mediaAlbum->getFile() === $this) {
                $mediaAlbum->setFile(null);
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
            $mediaCompilation->setFile($this);
        }

        return $this;
    }

    public function removeMediaCompilation(MediaCompilation $mediaCompilation): self
    {
        if ($this->mediaCompilations->contains($mediaCompilation)) {
            $this->mediaCompilations->removeElement($mediaCompilation);
            // set the owning side to null (unless already changed)
            if ($mediaCompilation->getFile() === $this) {
                $mediaCompilation->setFile(null);
            }
        }

        return $this;
    }

    public function getFormat(): ?string
    {
        return $this->format;
    }

    public function setFormat(?string $format): self
    {
        $this->format = $format;

        return $this;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(?string $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }


}
