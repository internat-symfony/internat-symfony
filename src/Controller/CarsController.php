<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarsController extends AbstractController
{
    #[Route('/cars', name: 'cars')]
    public function index(): Response
    {
        $cars=["toyota","audi","peugot","hyundai"];
    return $this->render('index.html.twig',array(
        'cars'=>$cars
    ));
    }    
  
    // public function oldMethod(): Response {
    //     return $this->json([
    //         'message' => 'Old Method.',
    //         'path' => 'src/Controller/CarsController.php',
    //     ]);
    // }
}
