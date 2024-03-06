<?php

namespace App\Entity;

use App\Repository\ProductsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductsRepository::class)]
class Products
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2)]
    private ?string $price = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\Column(length: 4)]
    private ?string $size = null;

    #[ORM\OneToMany(targetEntity: Categories::class, mappedBy: 'products')]
    private Collection $categories_id;

    #[ORM\Column]
    private ?int $amount = null;

    #[ORM\ManyToOne(inversedBy: 'product_id')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Orders $orders = null;

    public function __construct()
    {
        $this->categories_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getSize(): ?string
    {
        return $this->size;
    }

    public function setSize(string $size): static
    {
        $this->size = $size;

        return $this;
    }

    /**
     * @return Collection<int, Categories>
     */
    public function getCategoriesId(): Collection
    {
        return $this->categories_id;
    }

    public function addCategoriesId(Categories $categoriesId): static
    {
        if (!$this->categories_id->contains($categoriesId)) {
            $this->categories_id->add($categoriesId);
            $categoriesId->setProducts($this);
        }

        return $this;
    }

    public function removeCategoriesId(Categories $categoriesId): static
    {
        if ($this->categories_id->removeElement($categoriesId)) {
            // set the owning side to null (unless already changed)
            if ($categoriesId->getProducts() === $this) {
                $categoriesId->setProducts(null);
            }
        }

        return $this;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): static
    {
        $this->amount = $amount;

        return $this;
    }

    public function getOrders(): ?Orders
    {
        return $this->orders;
    }

    public function setOrders(?Orders $orders): static
    {
        $this->orders = $orders;

        return $this;
    }
}
