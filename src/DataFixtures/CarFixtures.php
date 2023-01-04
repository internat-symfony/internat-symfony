<?php

namespace App\DataFixtures;

use App\Entity\Cars;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CarFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
     $car= new Cars ();
     $car-> setCode('https://catalogue.automobile.tn/max/2020/01/46306.jpg?t=1668692446'); 
     $car-> setName('toyota 2015');
     $car-> setPrice('200 000 USD');
     $manager->persist($car);

     $car2= new Cars ();
     $car2-> setCode('https://upload.wikimedia.org/wikipedia/commons/0/0f/Peugeot_207_75_Forever_%28Facelift%29_%E2%80%93_Frontansicht%2C_5._Mai_2012%2C_Ratingen.jpg'); 
     $car2-> setName('peugot 206');
     $car2-> setPrice('15 000 USD');
     $manager->persist($car2);
     $manager->flush();
    }
}
