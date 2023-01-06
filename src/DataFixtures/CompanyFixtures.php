<?php

namespace App\DataFixtures;

use App\Entity\Company;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CompanyFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $company = new Company();
        $company->setCompanyName('toyota');
        $company->setCompanyOrigin('japan');

        //adding this data to pivot table
        
        $company->addCar($this->getReference('car_1'));
        
        $manager->persist($company);



        $company2 = new Company();
        $company2->setCompanyName('audi');
        $company2->setCompanyOrigin('germany');

        $company2->addCar($this->getReference('car_3'));

        $manager->persist($company2);




        $company3 = new Company();
        $company3->setCompanyName('peugeot');
        $company3->setCompanyOrigin('france');

        $company3->addCar($this->getReference('car_2'));
 
        $manager->persist($company3);

        $company4 = new Company();
        $company4->setCompanyName('ssongyong');
        $company4->setCompanyOrigin('korea');
        $manager->persist($company4);

        $company4->addCar($this->getReference('car_4'));

        $manager->flush();
    }
}
