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

    public function getPizzasWithIngredientCount()
    {
        return $this->createQueryBuilder('p')
            ->join('p.ingredients', 'i')
            ->select('p.name, COUNT(i.id) as ingredientCount')
            ->groupBy('p.id')
            ->having('COUNT(i.id) > 3')
            ->getQuery()->getResult();
    }

    public function getPizzasWithIngredients(
        array $ingredientIds,
    )
    {
        $qb = $this->createQueryBuilder('p')
            ->leftjoin('p.ingredients', 'i');

        $qb->where('i.id IN (:ingredientIds)')
            ->setParameter('ingredientIds', $ingredientIds)
            ->groupBy('p.id')
            ->having('COUNT(i.id) = ' . count($ingredientIds))
;

        return $qb->getQuery()->getResult();
    }

    //    /**
    //     * @return Pizza[] Returns an array of Pizza objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Pizza
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
