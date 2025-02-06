<?php

namespace App\Repository;

use App\Entity\Pizza;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Pizza>
 */
class PizzaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pizza::class);
    }

    public function getPizzaWithIngredientsCount($id)
    {
        $query = $this->createQueryBuilder('p')
            ->join('p.ingredients', 'i')
            ->select('p, COUNT(i, id) as nbIngredients')
            ->groupBy('p.$id')
            ->having('COUNT(i.id) > 3')
            ->getQuery()->getResult();
        return $query->getResult();
    }
}
