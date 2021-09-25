<?php

namespace App\Entity;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PaintingRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=PaintingRepository::class)
 */
class Painting
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
     * @ORM\Column(type="text", nullable=true)
     */
    private $discription;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $galleryImage;

    /**
     * @ORM\Column(type="boolean")
     */
    private $disponibility;

    /**
     * @ORM\Column(type="boolean")
     */
    private $saled;

    /**
     * @ORM\Column(type="integer")
     */
    private $priceOriginal;

    /**
     * @ORM\Column(type="integer")
     */
    private $priceOriginalSale;

    /**
     * @ORM\Column(type="integer")
     */
    private $priceReproduction;

    /**
     * @ORM\Column(type="integer")
     */
    private $priceReproductionSale;

    /**
     * @ORM\Column(type="integer")
     */
    private $priceFresco;

    /**
     * @ORM\Column(type="integer")
     */
    private $priceFrescoSale;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $hight;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $width;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $material;

    /**
     * @ORM\OneToMany(targetEntity=PaintingImage::class, mappedBy="painting")
     */
    private $paintingImages;

    /**
     * @ORM\ManyToMany(targetEntity=Category::class, mappedBy="paintings")
     */
    private $categories;

    /**
     * @ORM\ManyToMany(targetEntity=KeyWord::class, mappedBy="paintings")
     */
    private $keyWords;

    /**
     * @ORM\OneToMany(targetEntity=PaitingOrder::class, mappedBy="painting", orphanRemoval=true)
     */
    private $paitingOrders;

    /**
     * @ORM\Column(type="integer")
     */
    private $creationYear;

    public function __construct()
    {
        $this->paintingImages = new ArrayCollection();
        $this->categories = new ArrayCollection();
        $this->keyWords = new ArrayCollection();
        $this->paitingOrders = new ArrayCollection();

        $this->disponibility = true;
        $this->saled = false;
    }

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

    public function getDiscription(): ?string
    {
        return $this->discription;
    }

    public function setDiscription(?string $discription): self
    {
        $this->discription = $discription;

        return $this;
    }

    public function getGalleryImage(): ?string
    {
        return $this->galleryImage;
    }

    public function setGalleryImage(string $galleryImage): self
    {
        $this->galleryImage = $galleryImage;

        return $this;
    }

    public function getDisponibility(): ?bool
    {
        return $this->disponibility;
    }

    public function setDisponibility(bool $disponibility): self
    {
        $this->disponibility = $disponibility;

        return $this;
    }

    public function getSaled(): ?bool
    {
        return $this->saled;
    }

    public function setSaled(bool $saled): self
    {
        $this->saled = $saled;

        return $this;
    }

    public function getPriceOriginal(): ?int
    {
        return $this->priceOriginal;
    }

    public function setPriceOriginal(int $priceOriginal): self
    {
        $this->priceOriginal = $priceOriginal;

        return $this;
    }

    public function getPriceOriginalSale(): ?int
    {
        return $this->priceOriginalSale;
    }

    public function setPriceOriginalSale(int $priceOriginalSale): self
    {
        $this->priceOriginalSale = $priceOriginalSale;

        return $this;
    }

    public function getPriceReproduction(): ?int
    {
        return $this->priceReproduction;
    }

    public function setPriceReproduction(int $priceReproduction): self
    {
        $this->priceReproduction = $priceReproduction;

        return $this;
    }

    public function getPriceReproductionSale(): ?int
    {
        return $this->priceReproductionSale;
    }

    public function setPriceReproductionSale(int $priceReproductionSale): self
    {
        $this->priceReproductionSale = $priceReproductionSale;

        return $this;
    }

    public function getPriceFresco(): ?int
    {
        return $this->priceFresco;
    }

    public function setPriceFresco(int $priceFresco): self
    {
        $this->priceFresco = $priceFresco;

        return $this;
    }

    public function getPriceFrescoSale(): ?int
    {
        return $this->priceFrescoSale;
    }

    public function setPriceFrescoSale(int $priceFrescoSale): self
    {
        $this->priceFrescoSale = $priceFrescoSale;

        return $this;
    }


    public function getHight(): ?float
    {
        return $this->hight;
    }

    public function setHight(?float $hight): self
    {
        $this->hight = $hight;

        return $this;
    }

    public function getWidth(): ?float
    {
        return $this->width;
    }

    public function setWidth(?float $width): self
    {
        $this->width = $width;

        return $this;
    }

    public function getMaterial(): ?string
    {
        return $this->material;
    }

    public function setMaterial(?string $material): self
    {
        $this->material = $material;

        return $this;
    }

    /**
     * @return Collection|PaintingImage[]
     */
    public function getPaintingImages(): Collection
    {
        return $this->paintingImages;
    }

    public function addPaintingImage(PaintingImage $paintingImage): self
    {
        if (!$this->paintingImages->contains($paintingImage)) {
            $this->paintingImages[] = $paintingImage;
            $paintingImage->setPainting($this);
        }

        return $this;
    }

    public function removePaintingImage(PaintingImage $paintingImage): self
    {
        if ($this->paintingImages->removeElement($paintingImage)) {
            // set the owning side to null (unless already changed)
            if ($paintingImage->getPainting() === $this) {
                $paintingImage->setPainting(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Category[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
            $category->addPainting($this);
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        if ($this->categories->removeElement($category)) {
            $category->removePainting($this);
        }

        return $this;
    }

    /**
     * @return Collection|KeyWord[]
     */
    public function getKeyWords(): Collection
    {
        return $this->keyWords;
    }

    public function addKeyWord(KeyWord $keyWord): self
    {
        if (!$this->keyWords->contains($keyWord)) {
            $this->keyWords[] = $keyWord;
            $keyWord->addPainting($this);
        }

        return $this;
    }

    public function removeKeyWord(KeyWord $keyWord): self
    {
        if ($this->keyWords->removeElement($keyWord)) {
            $keyWord->removePainting($this);
        }

        return $this;
    }

    /**
     * @return Collection|PaitingOrder[]
     */
    public function getPaitingOrders(): Collection
    {
        return $this->paitingOrders;
    }

    public function addPaitingOrder(PaitingOrder $paitingOrder): self
    {
        if (!$this->paitingOrders->contains($paitingOrder)) {
            $this->paitingOrders[] = $paitingOrder;
            $paitingOrder->setPainting($this);
        }

        return $this;
    }

    public function removePaitingOrder(PaitingOrder $paitingOrder): self
    {
        if ($this->paitingOrders->removeElement($paitingOrder)) {
            // set the owning side to null (unless already changed)
            if ($paitingOrder->getPainting() === $this) {
                $paitingOrder->setPainting(null);
            }
        }

        return $this;
    }

    public function getCreationYear(): ?int
    {
        return $this->creationYear;
    }

    public function setCreationYear(int $creationYear): self
    {
        $this->creationYear = $creationYear;

        return $this;
    }
}
