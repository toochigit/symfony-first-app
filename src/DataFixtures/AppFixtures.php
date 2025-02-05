<?php

namespace App\DataFixtures;

use App\Entity\Person;
use App\Factory\AddressFactory;
use App\Factory\IngredientFactory;
use App\Factory\PersonFactory;
use App\Factory\PizzaFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        AddressFactory::createOne();
        AddressFactory::createOne(['city' => 'Paris']);
        AddressFactory::createMany(10, ['city' => 'Paris', 'zipCode' => '75001']);

        PersonFactory::createOne();
        PersonFactory::createOne(['lastName' => 'Jonathan']);
        PersonFactory::createMany(5, ['lastName' => 'Doe']);

        PersonFactory::createSequence([
                ['lastName' => 'Bohr'],
                ['lastName' => 'Schrodinger'],
                ['lastName' => 'Planq'],
            ]
        );

        IngredientFactory::createSequence([
            ['name' => 'Fromage'],
            ['name' => 'jambon'],
            ['name' => 'Feta'],
            ['name' => 'Speck'],
            ['name' => 'Champignon'],
            ['name' => 'Saumon'],
            ['name' => 'Artichaut'],
            ['name' => 'Aubergine'],
            ['name' => 'Courgette'],
            ['name' => 'Poulet'],
        ]);

        PizzaFactory::createSequence([
            ['name' => 'Calzone'],
            ['name' => '4 fromages'],
            ['name' => 'Parmigiano'],
            ['name' => 'Végétarienne'],
            ['name' => 'Américaine'],
            ['name' => 'Orientale'],
        ]);


    }
}
