<?php

namespace App\Factory;

use App\Dto\CreateProductsDto;
use App\Entity\Product;
use App\Exception\ProductNotFoundException;
use App\Exception\ProductUniqueException;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;

final readonly class ProductFactory
{

    /**
     * @param ProductRepository $productRepository
     */
    public function __construct(private readonly ProductRepository $productRepository, private readonly EntityManagerInterface $manager,
    ) {}

    public function create(array $productsData): void
    {
        foreach($productsData as $productData) {
            $productEntity = new Product();
            $product = $this->productRepository->findOneBy(['sku' => $productData['sku']]);
            if (null === $product) {
                $productEntity->setSku($productData['sku']);
                $productEntity->setName($productData['name']);
                $productEntity->setDescription($productData['description']);
                $this->manager->persist($productEntity);
            } else {
                throw new ProductUniqueException($productData['sku']);
            }
        }

        $this->manager->flush();
    }

    public function update(array $productsData): array
    {
        $productsUpdated = [];
        $productsNotFound = [];

        foreach($productsData as $productData) {
            $product = $this->productRepository->findOneBy(['sku' => $productData['sku']]);
            if ($product instanceof Product) {
                $product->setName($productData['name']);
                $product->setDescription($productData['description']);
                $this->manager->persist($product);
                $productsUpdated[] = $product->getSku();
            } else {
                $productsNotFound[] = $productData['sku'];
            }
        }

        if(count($productsUpdated) === 0){
            throw new ProductNotFoundException();
        }

        $this->manager->flush();
        return ['updated' => $productsUpdated, 'not_found' => $productsNotFound];
    }
}