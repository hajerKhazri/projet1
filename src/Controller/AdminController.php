<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\UserRepository;

final class AdminController extends AbstractController{
    
    #[Route('/admin', name: 'app_admin')]
    public function index(UserRepository $userRepository): Response
    {
        $totalPatients = $userRepository->countPatients();
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
            'total'=>$totalPatients,
        ]);

    }

}
