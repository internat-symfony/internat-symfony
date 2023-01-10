<?php

namespace App\Controller;

use App\Entity\Cars;
use App\Entity\MyCars;
use App\Form\CarsType;
use App\Repository\CarsRepository;
use App\Repository\MyCarsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/cars')]
class TheCarsController extends AbstractController
{
    #[Route('/getcarlist', name: 'app_the_cars_index', methods: ['GET'])]
  

    public function getCarList(MyCarsRepository $mycarsRepository, SerializerInterface $serializer): JsonResponse
    {
        $bookList = $mycarsRepository->findAll();
        $jsonCarList = $serializer->serialize($bookList, 'json');
        return new JsonResponse($jsonCarList, Response::HTTP_OK, [], true);
    }

    
    #[Route('/getcardetail/{id}', name: 'detailCar', methods: ['GET'])]
    public function getDetailCar(int $id, SerializerInterface $serializer, MyCarsRepository $mycarsRepository): JsonResponse {

        $car = $mycarsRepository->find($id);
        if ($car) {
            $jsonCar = $serializer->serialize($car, 'json');
            return new JsonResponse($jsonCar, Response::HTTP_OK, [], true);
        }
        return new JsonResponse(null, Response::HTTP_NOT_FOUND);
   }



   #[Route('/deletecar/{id}', name: 'deleteCar', methods: ['GET','DELETE'])]
   public function deleteCar(MyCars $car, EntityManagerInterface $em): JsonResponse 
   {
       $em->remove($car);
       $em->flush();

       return new JsonResponse(null, Response::HTTP_NO_CONTENT);
   }

  
   
   #[Route('/createcar', name:"createCar", methods: ['POST'])]
   public function createBook(Request $request, SerializerInterface $serializer, EntityManagerInterface $em, UrlGeneratorInterface $urlGenerator): JsonResponse 
   {

       $car = $serializer->deserialize($request->getContent(), MyCars::class, 'json');
       $em->persist($car);
       $em->flush();

       $jsonBook = $serializer->serialize($car, 'json', ['groups' => 'getCars']);
       
       $location = $urlGenerator->generate('detailCar', ['id' => $car->getId()], UrlGeneratorInterface::ABSOLUTE_URL);

       return new JsonResponse($jsonBook, Response::HTTP_CREATED, ["Location" => $location], true);
  }





  #[Route('/carupdate/{id}', name:"updateCar", methods:['PUT'])]

  public function updateBook(Request $request, SerializerInterface $serializer, MyCars $currentCar, EntityManagerInterface $em): JsonResponse 
  {
      $updatedCar = $serializer->deserialize($request->getContent(), 
              MyCars::class, 
              'json', 
              [AbstractNormalizer::OBJECT_TO_POPULATE => $currentCar]);
      $content = $request->toArray();
      // $idAuthor = $content['idAuthor'] ?? -1;
      // $updatedBook->setAuthor($authorRepository->find($idAuthor));
      
      $em->persist($updatedCar);
      $em->flush();
      return new JsonResponse(null, JsonResponse::HTTP_NO_CONTENT);
 }






    // #[Route('/new', name: 'app_the_cars_new', methods: ['GET', 'POST'])]
    // public function new(Request $request, MyCarsRepository $carsRepository): Response
    // {
    //     $car = new MyCars();
    //     $form = $this->createForm(CarsType::class, $car);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $carsRepository->save($car, true);
    //         return $this->redirectToRoute('app_the_cars_index', [], Response::HTTP_SEE_OTHER);
    //     }

    //     // return $this->render('the_cars/new.html.twig', [
    //     //     'car' => $car,
    //     //     'form' => $form,
    //     // ]);
    //     $cars=$carsRepository->find();

    //     $datas=array();
    //     foreach($car as $key =>$car){
    //      $datas[$key]['image'] =$car->getImage();
    //      $datas[$key]['name'] =$car->getName();
    //      $datas[$key]['price'] =$car->getPrice();
    //     }
    //      return new JsonResponse(array('name' => $datas));
    // }

    // #[Route('/{id}', name: 'app_the_cars_show', methods: ['GET'])]
    // public function show(MyCars $car): Response 
    // {

    //     $datas=array();
    //     foreach($car as $key =>$car){
    //      $datas[$key]['image'] =$car->getImage();
    //      $datas[$key]['name'] =$car->getName();
    //      $datas[$key]['price'] =$car->getPrice();
    //     }
    //     return new JsonResponse(array('name' => $datas));

    // }

    // #[Route('/{id}/edit', name: 'app_the_cars_edit', methods: ['GET', 'POST'])]
    // public function edit(Request $request, MyCars $car, MYCarsRepository $carsRepository): Response
    // {
    //     $form = $this->createForm(CarsType::class, $car);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $carsRepository->save($car, true);

    //         $datas=array();
    //         foreach($car as $key =>$car){
    //          $datas[$key]['image'] =$car->getImage();
    //          $datas[$key]['name'] =$car->getName();
    //          $datas[$key]['price'] =$car->getPrice();
    //         }
    //         return new JsonResponse(array('name' => $datas));
    //     }

    //     return $this->render('the_cars/edit.html.twig', [
    //         'car' => $car,
    //         'form' => $form,
    //     ]);
    // }


   
   
    // #[Route('/{id}', name: 'app_the_cars_delete', methods: ['POST'])]
    // public function delete(Request $request, MyCars $car, MyCarsRepository $carsRepository): Response
    // {
    //     if ($this->isCsrfTokenValid('delete'.$car->getId(), $request->request->get('_token'))) {
    //         $carsRepository->remove($car, true);
    //     }

    //     $datas=array();
    //     foreach($car as $key =>$car){
    //      $datas[$key]['image'] =$car->getImage();
    //      $datas[$key]['name'] =$car->getName();
    //      $datas[$key]['price'] =$car->getPrice();
    //     }
    //      return new JsonResponse(array('name' => $datas));    }
}
