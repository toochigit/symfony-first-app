<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RecipeController extends AbstractController
{

    public function getRecipeList(): array
    {
        return [
            [
                "id" => 1,
                "title" => "Quatre quarts",
                "ingredients" => [
                    "sucre",
                    "beurre",
                    "farine",
                    "oeufs"
                ],
                "kind" => "Dessert"
            ],
            [
                "id" => 2,
                "title" => "Taboulé",
                "ingredients" => [
                    "Semoule",
                    "citron",
                    "huile d'olive",
                    "persil"
                ],
                "kind" => "Entrée"
            ],
            [
                "id" => 3,
                "title" => "Houmous",
                "ingredients" => [
                    "pois chiche",
                    "tahin",
                    "huile d'olive",
                    "citron"
                ],
                "kind" => "Entrée"
            ],
            [
                "id" => 4,
                "title" => "Tajine",
                "ingredients" => [
                    "huile d'olive",
                    "tomates",
                    "courgettes",
                    "oignons",
                    "pommes de terre",
                    "abricots secs",
                    "olives vertes",
                    "cumin",
                ],
                "kind" => "Plat"
            ],

        ];
    }

    private function findOneById(int $id): array | null{
        $found =  array_filter($this->getRecipeList(), static function(array $item) use ($id){
            return $item["id"] === $id;
        });

        if($found && count($found)> 0){
            return array_values($found)[0];
        }

        return null;
    }

    private function findByKind($kind)
    {
        $found =  array_filter($this->getRecipeList(), static function(array $item) use ($kind){
            return $item["kind"] === $kind;
        });

        if($found && count($found)> 0){
            return array_values($found);
        }

        return null;

    }

}