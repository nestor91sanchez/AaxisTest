<?php


namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class CreateProductsDto
{
    #[Assert\NotBlank]
    #[Assert\Type("array")]
    #[Assert\All([
        'constraints' => [
            new Assert\Collection([
                'sku' => [
                    new Assert\NotBlank,
                    new Assert\Length(max: 50)
                ],
                'name' => [
                    new Assert\NotBlank,
                    new Assert\Length(max: 250)
                ],
                'description' => [
                    new Assert\Type('string'),
                    new Assert\Optional()
                ]
            ])
        ]
    ])]
    public array $products;

}