<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PsychiatreController extends AbstractController{
    #[Route('/psychiatre', name: 'app_psychiatre')]
    public function index(): Response
    {
        return $this->render('psychiatre/index.html.twig', [
            'controller_name' => 'PsychiatreController',
        ]);
    }
}
