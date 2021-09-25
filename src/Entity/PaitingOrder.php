<?php

namespace App\Entity;

use App\Repository\PaitingOrderRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PaitingOrderRepository::class)
 */
class PaitingOrder
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity=OrderRequest::class, inversedBy="paitingOrders")
     * @ORM\JoinColumn(nullable=false)
     */
    private $orderRequest;

    /**
     * @ORM\ManyToOne(targetEntity=Painting::class, inversedBy="paitingOrders")
     * @ORM\JoinColumn(nullable=false)
     */
    private $painting;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getOrderRequest(): ?OrderRequest
    {
        return $this->orderRequest;
    }

    public function setOrderRequest(?OrderRequest $orderRequest): self
    {
        $this->orderRequest = $orderRequest;

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
