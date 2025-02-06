<?php

namespace App\Controller;

use App\Entity\Pizza;
use App\Repository\PizzaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PizzaController extends AbstractController
{
    #[Route('/pizza', name: 'app_pizza')]
    public function index(
        PizzaRepository $Repository,
    ): Response
    {
        $pizza = new Pizza();
        $pizza->setName('Parmigiano');

        $pizzas = $Repository->findAll();

        return $this->render('pizza/index.html.twig', [
            'pizza' => $pizza,
            'pizzas' => $pizzas,
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

        return $this->redirectToRoute('app_pizza');
    }

    #[Route('/pizza/delete/{id}', name: 'app_pizza_delete')]
    public function delete(
        int                    $id,
        EntityManagerInterface $entityManager,
        PizzaRepository        $repository
    ): Response
    {
        $pizza = $repository->findOneBy(['id' => $id]);
        if ($pizza) {
            $entityManager->remove($pizza);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_pizza');
    }

    #[Route('/pizza/update/{id}/{name}', name: 'app_pizza_update')]
    public function update(
        int                    $id,
        string                 $name,
        EntityManagerInterface $entityManager,
        PizzaRepository        $repository
    ): Response
    {
        $pizza = $repository->findOneBy(['id' => $id]);

        if ($pizza) {
            $pizza->setName($name);
            $entityManager->persist($pizza);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_pizza');
    }

    #[Route('/pizza/groupby', name: 'app_pizza_groupby')]
    function groupBy(
        PizzaRepository $repository,
    ): Response
    {
        $pizzas = $repository->getPizzaWithIngredientsCount();
        return $this->render('pizza/groupby.html.twig', ['pizzas' => $pizzas]);
    }
}

