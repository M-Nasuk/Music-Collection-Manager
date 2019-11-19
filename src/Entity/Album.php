<?php

namespace App\Entity;

use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AlbumRepository")
 */
class Album implements CollectionInterface
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $picture;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $releaseDate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Artist", inversedBy="albums")
     */
    protected $artist;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PlaylistAlbum", mappedBy="album")
     */
    protected $playlistAlbums;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\MediaAlbum", mappedBy="album", cascade={"persist", "remove"})
     */
    private $mediaAlbum;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Track", mappedBy="album")
     */
    private $tracks;


    public function __construct()
    {
        $this->tracks = new ArrayCollection();
        $this->playlistAlbums = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Album
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
//
//    public function __toString()
//    {
//        return (string) $this->id;
//    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

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

    public function getReleaseDate(): ?DateTimeInterface
    {
        return $this->releaseDate;
    }

    public function setReleaseDate(?DateTimeInterface $releaseDate): self
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }


    public function getArtist(): ?Artist
    {
        return $this->artist;
    }

    public function setArtist(?Artist $artist): self
    {
        $this->artist = $artist;

        return $this;
    }


    /**
     * @return Collection|PlaylistAlbum[]
     */
    public function getPlaylistAlbums(): Collection
    {
        return $this->playlistAlbums;
    }

    public function addPlaylistAlbum(PlaylistAlbum $playlistAlbum): self
    {
        if (!$this->playlistAlbums->contains($playlistAlbum)) {
            $this->playlistAlbums[] = $playlistAlbum;
            $playlistAlbum->setAlbum($this);
        }

        return $this;
    }

    public function removePlaylistAlbum(PlaylistAlbum $playlistAlbum): self
    {
        if ($this->playlistAlbums->contains($playlistAlbum)) {
            $this->playlistAlbums->removeElement($playlistAlbum);
            // set the owning side to null (unless already changed)
            if ($playlistAlbum->getAlbum() === $this) {
                $playlistAlbum->setAlbum(null);
            }
        }

        return $this;
    }

    public function getMediaAlbum(): ?MediaAlbum
    {
        return $this->mediaAlbum;
    }

    public function setMediaAlbum(?MediaAlbum $mediaAlbum): self
    {
        $this->mediaAlbum = $mediaAlbum;

        // set (or unset) the owning side of the relation if necessary
        $newAlbum = $mediaAlbum === null ? null : $this;
        if ($newAlbum !== $mediaAlbum->getAlbum()) {
            $mediaAlbum->setAlbum($newAlbum);
        }

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
            $track->setAlbum($this);
        }

        return $this;
    }

    public function removeTrack(Track $track): self
    {
        if ($this->tracks->contains($track)) {
            $this->tracks->removeElement($track);
            // set the owning side to null (unless already changed)
            if ($track->getAlbum() === $this) {
                $track->setAlbum(null);
            }
        }

        return $this;
    }

}
