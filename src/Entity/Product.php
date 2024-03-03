<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProductRepository;
use DateTimeInterface;
use Doctrine\DBAL\Types\Types;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[ORM\Table(name: 'product')]
#[UniqueEntity(fields: ['sku'], errorPath: 'title', message: 'product.sku_unique')]
#[ORM\HasLifecycleCallbacks]
class Product
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private ?int $id = null;

    #[ORM\Column(type: Types::STRING, length: 50, unique: true, nullable: false)]
    #[Assert\Unique]
    #[Assert\NotBlank(message: 'product.blank_sku')]
    #[Assert\Length(max: 50, maxMessage: 'product.too_long_sku')]
    private string $sku;

    #[ORM\Column(name: "product_name", type: Types::STRING, length: 250, nullable: false)]
    #[Assert\Length(max: 250, maxMessage: 'product.too_long_name')]
    private string $name;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(name: "created_at", type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $createdAt;

    #[ORM\Column(name: "updated_at", type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $updatedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSku(): string
    {
        return $this->sku;
    }

    public function setSku(string $sku): void
    {
        $this->sku = $sku;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }


    public function getDescription(): ?string
    {
        return $this->description;
    }


    #[ORM\PrePersist]
    public function setCreatedAtValue(): void
    {
        $this->createdAt = new \DateTime();
        $this->setUpdatedAtValue();
    }

    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    #[ORM\PreUpdate]
    public function setUpdatedAtValue(): void
    {
        $this->updatedAt = new \DateTime();
    }

    public function getUpdatedAt(): DateTimeInterface
    {
        return $this->updatedAt;
    }

}