<?php

namespace App\DataFixtures;

use App\Entity\Ingredient;
use App\Entity\Pizza;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PizzaFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $pizza = new Pizza();
        $pizza->setName('Spécialité du Chef');
        $pizza->addIngredient(
            $this->getReference('ingredient jambon',Ingredient::class)
        );
        $pizza->addIngredient(
            $this->getReference('ingredient fromage',Ingredient::class)
        );

        $manager->persist($pizza);

        $manager->flush();
    }
}
