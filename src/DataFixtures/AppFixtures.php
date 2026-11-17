<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Category;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //Création d'un objet Faker
        $faker = Faker\Factory::create('fr_FR');

        for ($i=0; $i < 10; $i++) { 
            //Créer des objets 
            $category = new Category();
            $category->setName($faker->word());
            
            //persister l'objet
            $manager->persist($category);
        }
        
        //envoyer et exécuter la requête insert
        $manager->flush();
    }
}
