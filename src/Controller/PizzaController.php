<?php

namespace App\Controller;

use App\Entity\Pizza;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PizzaController extends AbstractController
{
    #[Route('/pizza', name: 'app_pizza')]
    public function index(): Response
    {
        $pizza = new Pizza();
        $pizza->setName('Parmigiano');

        return $this->render('pizza/index.html.twig', [
            'pizza' => $pizza,
        ]);
    }

    #[Route('/pizza/insert', name: 'app_pizza_insert')]
    public function insert(
        EntityManagerInterface $entityManager,
    ): Response
    {
        $pizza = new Pizza();
        $pizza->setName('Calzone');

        $entityManager->persist($pizza);
        $entityManager->flush();

        return $this->render('pizza/index.html.twig', [
            'pizza' => $pizza,
        ]);
    }
}

