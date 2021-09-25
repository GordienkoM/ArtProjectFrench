<?php

namespace App\Entity;

use App\Entity\Painting;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PaintingImageRepository;

/**
 * @ORM\Entity(repositoryClass=PaintingImageRepository::class)
 */
class PaintingImage
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=Painting::class, inversedBy="paintingImages")
     * @ORM\JoinColumn(nullable=true, onDelete="SET NULL")
     */
    private $painting;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPainting(): ?Painting
    {
        return $this->painting;
    }

    public function setPainting(?Painting $painting): self
    {
        $this->painting = $painting;

        return $this;
    }

}
