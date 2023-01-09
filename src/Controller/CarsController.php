<?php

namespace App\Controller;

use App\Entity\Cars;
use App\Repository\CarsRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


class CarsController extends AbstractController
{

    private $em;
    public function __construct(EntityManagerInterface $doctrine)
    {
    //    $this->doctrine = $doctrine;
    }

    #[Route('/cars',methods:['GET'])]
    public function getCars(ManagerRegistry $doctrine): Response
    {
        $car=$doctrine->getRepository(Cars::class)->findAll();
        
        // echo($car);
        // dd($car);
        return $this->json($car);
    }
    // public function getCars(CarsRepository $carsRepository): JsonResponse
    // {
    //     return $this->json( [
    //         'cars' => $carsRepository->findAll(),
    //     ]);
    // }

    // function console_log($output, $with_script_tags = true) {
    //     $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
    // ');';
    //     if ($with_script_tags) {
    //         $js_code = '<script>' . $js_code . '</script>';
    //     }
    //     echo $js_code;
    // }
    
    
    
    
    
    #[Route('/findcar/{id}',methods:['GET'])]
    public function findCar($id): Response
    {
        $repository=$this->em->getRepository(Cars::class);
        $car= $repository->find($id);

        dd($car);
         return $this->json($car);
    }
    #[Route('/cars/delete/{id}',methods:['GET','DELETE'])]
    public function deleteCar($id): Response
    {
        $repository=$this->em->getRepository(Cars::class);
        $car= $repository->find($id);
        $this->em->remove($car);
        $this->em->flush();

        return $this->json($car); 
    }


    public function saveCar($name, $price, $code)
    {
        $newCar = new Cars();
        $newCar
            ->setName($name)
            ->setPrice($price)
            ->setCode($code);
        $this->em->persist($newCar);
        $this->em->flush();
    }


    #[Route('/cars/addcar',methods:['GET','POST'], name: 'postcar')]

    public function addCar(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $name = $data['name'];
        $price = $data['price'];
        $code = $data['code'];

        if (empty($name) || empty($price) || empty($code) ) {
            throw new NotFoundHttpException('Expecting mandatory parameters!');
        }

        $this->em->getRepository($name, $price, $code);

        return new JsonResponse(['status' => 'Customer created!'], Response::HTTP_CREATED);    }
}





    // public function oldMethod(): Response {
    //     return $this->json([
    //         'message' => 'Old Method.',
    //         'path' => 'src/Controller/CarsController.php',
    //     ]);
    // }

