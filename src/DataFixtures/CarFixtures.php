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
     $car2-> setName('peugeot 206');
     $car2-> setPrice('15 000 USD');
     $manager->persist($car2);
     $manager->flush();

     $car3= new Cars ();
     $car3-> setCode('https://catalogue.automobile.tn/big/2022/10/46692.jpg?t=1666960750'); 
     $car3-> setName('audi a4');
     $car3-> setPrice('300 000 USD');
     $manager->persist($car3);
     $manager->flush();

     $car4= new Cars ();
     $car4-> setCode('https://catalogue.automobile.tn/max/2022/07/80105_max.jpeg?t=1657738323'); 
     $car4-> setName('ssongyong action 2016');
     $car4-> setPrice('45 000 USD');
     $manager->persist($car4);
     
     $manager->flush();
    
    $this->addReference('car_1',$car);
    $this->addReference('car_2',$car2);
    $this->addReference('car_3',$car3);
    $this->addReference('car_4',$car4);
}
}
