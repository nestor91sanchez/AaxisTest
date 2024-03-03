<?php

namespace App\Dto;

Trait ProductTrait
{
    private string $sku;
    private string $name;
    private ?string $description = null;

    private ?\DateTimeInterface $createdAt = null;

    /**
     * @param string $sku
     * @return ProductTrait|ProductSummaryDto
     */
    public function setSku(string $sku): self
    {
        $this->sku = $sku;
        return $this;
    }

    /**
     * @return string
     */
    public function getSku(): string
    {
        return $this->sku;
    }

    /**
     * @param string $name
     * @return ProductTrait|ProductSummaryDto
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }


    /**
     * @param string|null $description
     * @return ProductTrait|ProductSummaryDto
     */
    public function setDescription(?string $description = null): self
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param \DateTimeInterface|null $createdAt
     * @return ProductTrait|ProductSummaryDto
     */
    public function setCreatedAt(?\DateTimeInterface $createdAt = null): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }
}