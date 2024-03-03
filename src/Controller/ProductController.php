<?php

namespace App\Controller;

use App\ArgumentResolver\Body;
use App\ArgumentResolver\QueryParam;
use App\Dto\CreateProductsDto;
use App\Dto\ProductSummaryDto;
use App\Factory\ProductFactory;
use App\Repository\ProductRepository;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use OpenApi\Attributes as OA;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
#[Route(path: "/api/products")]
class ProductController extends AbstractController implements LoggerAwareInterface
{

    private LoggerInterface $logger;

    /**
     * @param ProductFactory $productFactory
     * @param ProductRepository $products
     */
    public function __construct(
        private readonly ProductFactory $productFactory,
        private readonly ProductRepository $products,
    ) {
    }

    #[Route(path: "", name: "all", methods: ["GET"])]
    #[OA\Response(
        response: 200,
        description: 'Get All Products',
        content: new OA\JsonContent(
            type: 'array',
            items: new OA\Items(ref: new Model(type: ProductSummaryDto::class, groups: ['full']))
        )
    )]
    #[OA\Tag(name: 'Products')]
    #[Security(name: 'Bearer')]
    public function all(
        #[QueryParam] string $keyword,
        #[QueryParam] int $offset = 0,
        #[QueryParam] int $limit = 20
    ): Response {
        $this->logger->debug("request param: keyword=[" . $keyword . "], offset=[" . $offset . "], limit=[" . $limit . "]");
        $data = $this->products->findByKeyword($keyword ?: '', $offset, $limit);
        $this->logger->debug("find all result:[" . $data . "]");
        return $this->json($data);
    }

    #[Route(path: "", name: "create", methods: ["POST"])]
    #[OA\RequestBody(description: 'Create Products.', required: false, content: new Model(type: CreateProductsDto::class))]
    #[OA\Tag(name: 'Products')]
    #[Security(name: 'Bearer')]
    public function create(#[Body] CreateProductsDto $data): Response
    {
        $this->productFactory->create($data->products);
        return $this->json(['success' => 'products created'], 201);
    }

    #[Route(path: "", name: "update", methods: ["PUT"])]
    #[OA\RequestBody(description: 'Update Products.', required: false, content: new Model(type: CreateProductsDto::class))]
    #[OA\Tag(name: 'Products')]
    #[Security(name: 'Bearer')]
    public function update(#[Body] CreateProductsDto $data): Response
    {
        $productData = $this->productFactory->update($data->products);
        $response = ['success' => $productData['updated']];
        if (count($productData['not_found']) > 0) {
            $response['error'] = [
                'message' => 'Products not found: '. implode( ", ", $productData['not_found'] ),
                'skus' => $productData['not_found']
            ];
        }

        return $this->json(['products' => $response]);
    }


    public function setLogger(LoggerInterface $logger): void
    {
        $this->logger = $logger;
    }
}
