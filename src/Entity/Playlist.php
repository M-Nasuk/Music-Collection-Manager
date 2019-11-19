<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PlaylistRepository")
 */
class Playlist implements CollectionInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;


    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $title;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PlaylistAlbum", mappedBy="playlist")
     */
    protected $playlistAlbums;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PlaylistTrack", mappedBy="playlist")
     */
    protected $playlistTracks;

    public function __construct()
    {
        $this->playlistAlbums = new ArrayCollection();
        $this->playlistTracks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
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
            $playlistAlbum->setPlaylist($this);
        }

        return $this;
    }

    public function removePlaylistAlbum(PlaylistAlbum $playlistAlbum): self
    {
        if ($this->playlistAlbums->contains($playlistAlbum)) {
            $this->playlistAlbums->removeElement($playlistAlbum);
            // set the owning side to null (unless already changed)
            if ($playlistAlbum->getPlaylist() === $this) {
                $playlistAlbum->setPlaylist(null);
            }
        }

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
            $playlistTrack->setPlaylist($this);
        }

        return $this;
    }

    public function removePlaylistTrack(PlaylistTrack $playlistTrack): self
    {
        if ($this->playlistTracks->contains($playlistTrack)) {
            $this->playlistTracks->removeElement($playlistTrack);
            // set the owning side to null (unless already changed)
            if ($playlistTrack->getPlaylist() === $this) {
                $playlistTrack->setPlaylist(null);
            }
        }

        return $this;
    }
}
