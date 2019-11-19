<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TrackRepository")
 */
class Track
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Artist", inversedBy="tracks")
     */
    protected $artist;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PlaylistTrack", mappedBy="track")
     */
    protected $playlistTracks;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $duration;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Compilation", inversedBy="tracks")
     */
    private $compilation;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Album", inversedBy="tracks")
     */
    private $album;


    /**
     * Track constructor.
     */
    public function __construct()
    {
        $this->playlistTracks = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Track
     */
    public function setId($id): self
    {
        $this->id = $id;

        return $this;
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
     * @return Collection|PlaylistTrack[]
     */
    public function getPlaylistTracks(): Collection
    {
        return $this->playlistTracks;
    }

    public function addPlaylistTrack(PlaylistTrack $playlistTrack): self
    {
        if (!$this->playlistTracks->contains($playlistTrack)) {
            $this->playlistTracks[] = $playlistTrack;
            $playlistTrack->setTrack($this);
        }

        return $this;
    }

    public function removePlaylistTrack(PlaylistTrack $playlistTrack): self
    {
        if ($this->playlistTracks->contains($playlistTrack)) {
            $this->playlistTracks->removeElement($playlistTrack);
            // set the owning side to null (unless already changed)
            if ($playlistTrack->getTrack() === $this) {
                $playlistTrack->setTrack(null);
            }
        }

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(?int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getCompilation(): ?Compilation
    {
        return $this->compilation;
    }

    public function setCompilation(?Compilation $compilation): self
    {
        $this->compilation = $compilation;

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
