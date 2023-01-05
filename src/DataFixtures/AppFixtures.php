<?php

namespace App\DataFixtures;

use App\Entity\Brand;
use App\Entity\Car;
use App\Entity\Model;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $b1 = new Brand();
        $b1->setName("Yotota");
        $manager->persist($b1);

        $b2 = new Brand();
        $b2->setName("Jeupot");
        $manager->persist($b2);

        $m1 = new Model();
        $m1->setName("Rayis")
        ->setImage("model1.png")
        ->setPrice(15000)
        ->setBrand($b1);
        $manager->persist($m1);

        $m2 = new Model();
        $m2->setName("Yraus")
            ->setImage("model2.png")
            ->setPrice(20000)
            ->setBrand($b1);
        $manager->persist($m2);

        $m3 = new Model();
        $m3->setName("007")
            ->setImage("model3.png")
            ->setPrice(30000)
            ->setBrand($b1);
        $manager->persist($m3);

        $m4 = new Model();
        $m4->setName("008")
            ->setImage("model4.png")
            ->setPrice(40000)
            ->setBrand($b2);
        $manager->persist($m4);

        $m5 = new Model();
        $m5->setName("009")
            ->setImage("model5.png")
            ->setPrice(50000)
            ->setBrand($b2);
        $manager->persist($m5);

        $models = [$m1, $m2, $m3, $m4, $m5];

        $faker = \Faker\Factory::create('fr_FR');

        foreach($models as $m){
            $rand = rand(3,5);
            for($i=1; $i <= $rand; $i++) {
                $c = new Car();
                $c->setRegistration($faker->regexify("[A-Z]{2}[0-9]{3,4}[A-Z]{2}"))
                    ->setDoors($faker->randomElement($array = array(3,5)))
                    ->setYear($faker->numberBetween($min = 1990, $max = 2021))
                    ->setModel($m);
                $manager->persist($c);
            }
        }

        $manager->flush();
    }
}
