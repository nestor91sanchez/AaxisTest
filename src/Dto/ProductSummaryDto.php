<?php

namespace App\Dto;

class ProductSummaryDto
{
    use ProductTrait;
    private string $id;

    static function of(string $id, string $sku, string $name, string $description = null, ?\DateTimeInterface $createdAt = null): ProductSummaryDto
    {
        $dto = new ProductSummaryDto();
        $dto->setId($id)->setSku($sku)->setName($name)->setDescription($description)->setCreatedAt($createdAt);
        return $dto;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return ProductSummaryDto
     */
    public function setId(string $id): ProductSummaryDto
    {
        $this->id = $id;
        return $this;
    }

    public function __toString(): string
    {
        return "ProductSummaryDto[sku=." . $this->sku . ", name=." . $this->name . ", id." . $this->id . "]";
    }

}