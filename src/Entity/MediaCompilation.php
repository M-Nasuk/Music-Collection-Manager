<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MediaCompilationRepository")
 */
class MediaCompilation extends AbstractMedia
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Disk", inversedBy="mediaCompilations")
     */
    protected $disk;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Vinyle", inversedBy="mediaCompilations")
     */
    protected $vinyle;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Compilation", inversedBy="mediaCompilation", cascade={"persist", "remove"})
     */
    private $compilation;


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

    public function getCompilation(): ?Compilation
    {
        return $this->compilation;
    }

    public function setCompilation(?Compilation $compilation): self
    {
        $this->compilation = $compilation;

        return $this;
    }

}
