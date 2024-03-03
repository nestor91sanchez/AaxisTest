<?php

namespace App\Repository;

use App\Dto\Page;
use App\Dto\ProductSummaryDto;
use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    function getEntityManager(): EntityManagerInterface
    {
        return parent::getEntityManager();
    }

    public function findByKeyword(string $q, int $offset = 0, int $limit = 20): Page
    {
        $query = $this->createQueryBuilder("p")
            ->andWhere("p.name like :q or p.description like :q")
            ->setParameter('q', "%" . $q . "%")
            ->orderBy('p.createdAt', 'DESC')
            ->setMaxResults($limit)
            ->setFirstResult($offset)
            ->getQuery();

        $paginator = new Paginator($query, $fetchJoinCollection = false);
        $c = count($paginator);
        $products = new ArrayCollection();
        foreach ($paginator as $product) {
            $products->add(ProductSummaryDto::of($product->getId(), $product->getSku(), $product->getName(), $product->getDescription(), $product->getCreatedAt()));
        }
        return Page::of ($products, $c, $offset, $limit);
    }

}