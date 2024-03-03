<?php

namespace App\DataFixtures;

use App\Factory\ProductFactory;
use App\Repository\ProductRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{

    /**
     * @param ProductFactory $productFactory
     */
    public function __construct(private readonly ProductFactory $productFactory, private readonly UserPasswordHasherInterface $passwordHasher) {}


    public function load(ObjectManager $manager): void
    {
        $this->loadUsers($manager);
        $this->loadProducts();
        $manager->flush();
    }

    private function loadUsers($manager): void
    {
        $user1 = new User();
        $user1->setUsername('aaxis_user');
        $user1->setRoles([]);
        $hashedPassword = $this->passwordHasher->hashPassword($user1, 'aaxis2024');
        $user1->setPassword($hashedPassword);
        $manager->persist($user1);

        $user2 = new User();
        $user2->setUsername('nestor');
        $user2->setRoles([]);
        $hashedPassword = $this->passwordHasher->hashPassword($user2, 'nestor2024');
        $user2->setPassword($hashedPassword);
        $manager->persist($user2);
    }

    private function loadProducts(): void
    {
        $productsData =  [
            [
                "sku" => "123",
                "name" => "Product 1",
                "description" => "This is product 1"
            ],
            [
                "sku" => "456",
                "name" => "Product 2",
                "description" => "This is product 2"
            ],
            [
                "sku" => "789",
                "name" => "Product 3",
                "description" => ""
            ],
            [
                "sku" => "1011",
                "name" => "Product 4",
                "description" => "product 4"
            ]
        ];

        $this->productFactory->create($productsData);
    }
}
