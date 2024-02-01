<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BaguetteController extends AbstractController
{
    #[Route('/baguette', name: 'app_baguette')]
    public function index(): Response
    {
        return $this->render('baguette/index.html.twig', [
            'controller_name' => 'BaguetteController',
        ]);
    }
}
