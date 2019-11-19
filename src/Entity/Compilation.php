<?php

namespace App\Entity;

use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CompilationRepository")
 */
class Compilation implements CollectionInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $title;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $releaseDate;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $picture;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Track", mappedBy="compilation")
     */
    private $tracks;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\MediaCompilation", mappedBy="compilation", cascade={"persist", "remove"})
     */
    private $mediaCompilation;


    public function __construct()
    {
        $this->mediaCompilations = new ArrayCollection();
        $this->tracks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getReleaseDate(): ?DateTimeInterface
    {
        return $this->releaseDate;
    }

    public function setReleaseDate(?DateTimeInterface $releaseDate): self
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * @return Collection|Track[]
     */
    public function getTracks(): Collection
    {
        return $this->tracks;
    }

    public function addTrack(Track $track): self
    {
        if (!$this->tracks->contains($track)) {
            $this->tracks[] = $track;
            $track->setCompilation($this);
        }

        return $this;
    }

    public function removeTrack(Track $track): self
    {
        if ($this->tracks->contains($track)) {
            $this->tracks->removeElement($track);
            // set the owning side to null (unless already changed)
            if ($track->getCompilation() === $this) {
                $track->setCompilation(null);
            }
        }

        return $this;
    }

    public function getMediaCompilation(): ?MediaCompilation
    {
        return $this->mediaCompilation;
    }

    public function setMediaCompilation(?MediaCompilation $mediaCompilation): self
    {
        $this->mediaCompilation = $mediaCompilation;

        // set (or unset) the owning side of the relation if necessary
        $newCompilation = $mediaCompilation === null ? null : $this;
        if ($newCompilation !== $mediaCompilation->getCompilation()) {
            $mediaCompilation->setCompilation($newCompilation);
        }

        return $this;
    }

}
