<?php

namespace App\Dto;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use JetBrains\PhpStorm\Pure;

class Page
{
    private Collection $products;
    private int $totalElements;
    private int $offset;
    private int $limit;

    #[Pure] public function __construct()
    {
        $this->products = new ArrayCollection();
    }


    public static function of(Collection $products, int $totalElements, int $offset = 0, int $limit = 20): Page
    {
        $page = new Page();
        $page->setProducts($products)
            ->setTotalElements($totalElements)
            ->setOffset($offset)
            ->setLimit($limit);

        return $page;
    }

    /**
     * @param Collection $products
     * @return Page
     */
    public function setProducts(Collection $products): Page
    {
        $this->products = $products;
        return $this;
    }

    /**
     * @param int $totalElements
     * @return Page
     */
    public function setTotalElements(int $totalElements): Page
    {
        $this->totalElements = $totalElements;
        return $this;
    }

    /**
     * @param int $offset
     * @return Page
     */
    public function setOffset(int $offset): Page
    {
        $this->offset = $offset;
        return $this;
    }

    /**
     * @param int $limit
     * @return Page
     */
    public function setLimit(int $limit): Page
    {
        $this->limit = $limit;
        return $this;
    }


    /**
     * @return Collection
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    /**
     * @return int
     */
    public function getTotalElements(): int
    {
        return $this->totalElements;
    }

    /**
     * @return int
     */
    public function getOffset(): int
    {
        return $this->offset;
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    public function __toString(): string
    {
        return "Page[totalElements=" . $this->totalElements
            . ",offset=" . $this->offset
            . ",limit=" . $this->offset
            . ",products=" . $this->products
            . "]";
    }


}