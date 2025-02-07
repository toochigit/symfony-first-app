<?php

namespace App\DataFixtures;

use App\Entity\Person;
use App\Factory\AddressFactory;
use App\Factory\CommentFactory;
use App\Factory\IngredientFactory;
use App\Factory\PersonFactory;
use App\Factory\PizzaFactory;
use App\Factory\PostFactory;
use App\Factory\PostThemeFactory;
use App\Factory\TagFactory;
use App\Factory\UserFactory;
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

        TagFactory::createSequence([
            ['tagName' => 'Symfony'],
            ['tagName' => 'PHP'],
            ['tagName' => 'JavaScript'],
            ['tagName' => 'Java'],
            ['tagName' => 'C#'],
            ['tagName' => 'Flutter'],
            ['tagName' => 'Android'],
            ['tagName' => 'Linux'],
            ['tagName' => 'MacOS'],
            ['tagName' => 'Hibernate'],
            ['tagName' => 'Windows'],
            ['tagName' => 'Spring'],
            ['tagName' => 'Docker'],
        ]);

        PostThemeFactory::createSequence([
            ['themeName' => 'Informatique'],
            ['themeName' => 'Société'],
            ['themeName' => 'Sport'],
            ['themeName' => 'Politique'],
            ['themeName' => 'International'],
        ]);

        UserFactory::createSequence([
            ['nickName' => 'Lulu Lemonade'],
            ['nickName' => 'Ninja Noodles'],
            ['nickName' => 'Poppy Rainbow'],
            ['nickName' => 'Bubbles O\'Laugh'],
            ['nickName' => 'Jelly bean'],
            ['nickName' => 'Pixel Pusher'],
            ['nickName' => 'Code Cruncher'],
            ['nickName' => 'Geek Guru'],
            ['nickName' => 'Night Owl'],
            ['nickName' => 'Linux Lover'],
            ['nickName' => 'Joystick Jester'],
            ['nickName' => 'Mouse Jostler'],
            ['nickName' => 'Salad Samuraï'],
            ['nickName' => 'Coffee Lover'],
            ['nickName' => 'Wee Lassie Gamer'],
            ['nickName' => 'Banjaxed eejit'],
        ]);

        PostFactory::createMany(100, [
            'tags' => TagFactory::randomRange(0,5),
        ]);

        CommentFactory::createMany(500);

    }
}
