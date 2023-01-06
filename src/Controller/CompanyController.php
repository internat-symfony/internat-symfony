<?php

namespace App\Controller;

use App\Entity\Company;
use App\Repository\CompanyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use Symfony\Component\Routing\Annotation\Route;

class CompanyController extends AbstractController
{
    private $em;
    public function __construct(EntityManagerInterface $em)
    {
       $this->em = $em;
    }
    #[Route('/company',methods:['GET'])]
    public function index(): Response
    {
        // $company= $companyRepository->findAll();
        $repository=$this->em->getRepository(Company::class);
        $company= $repository->findAll();

        dd($company);
        // return $this->render('company/index.html.twig');
        return $this->json($company);
    }
    #[Route('/company/find/{id}',methods:['GET'])]
    public function findCompany($id): Response
    {
        $repository=$this->em->getRepository(Company::class);
        $company= $repository->find($id);

        dd($company);
         return $this->json($company);

    }

    #[Route('/company/delete/{id}',methods:['GET','DELETE'])]
    public function deleteCompany($id): Response
    {
        $repository=$this->em->getRepository(Company::class);
        $company= $repository->find($id);
        $this->em->remove($company);
        $this->em->flush();

         return $this->json($company);
    }
}
