<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HealthCheckController extends AbstractController
{
    /**
     * @param Request $request
     * @return Response
     */
    #[Route('/healthcheck', name: 'healthcheck')]
    public function sayHello(Request $request): Response
    {
        return $this->json("we are online");
    }
}
