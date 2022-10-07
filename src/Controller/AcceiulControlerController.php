<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AcceiulControlerController extends AbstractController
{
    #[Route('/acceiul/controler', name: 'app_acceiul_controler')]
    public function index(): Response
    {
        return $this->render('acceiul_controler/index.html.twig', [
            'controller_name' => 'AcceiulControlerController',
        ]);
    }
}
