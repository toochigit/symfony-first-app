<?php

namespace App\DataFixtures;

use App\Entity\Ingredient;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class IngredientFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $ingredient = new Ingredient();
        $ingredient->setName("poulet");
        $manager->persist($ingredient);
        $this->addReference('ingredient poulet', $ingredient);

        $ingredient = new Ingredient();
        $ingredient->setName("Jambon");
        $manager->persist($ingredient);
        $this->addReference('ingredient jambon', $ingredient);

        $ingredient = new Ingredient();
        $ingredient->setName("champignon");
        $manager->persist($ingredient);
        $this->addReference('ingredient champignon', $ingredient);

        $ingredient = new Ingredient();
        $ingredient->setName("fromage");
        $manager->persist($ingredient);
        $this->addReference('ingredient fromage', $ingredient);



        $manager->flush();
    }
}
