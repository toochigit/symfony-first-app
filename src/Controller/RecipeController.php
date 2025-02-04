<?php

namespace App\Controller;

use App\Service\RecipeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Flex\Recipe;

#[Route('/recettes', name: 'recipe')]
class RecipeController extends AbstractController
{
    public function __construct(
        private RecipeService $recipeService
    ){}

    #[Route('/', name: '_index')]
    public function index(): Response {
        return $this->render('recipe/index.html.twig', [
            'recipeList' => $this->recipeService->getRecipeList(),
            'kind' => 'recette',
        ]);
    }

    #[Route('/{id}', name: '_details', requirements: ['id' => '\d+'])]
    public function details(int $id): Response {
        $recipe = $this->recipeService->findOneById($id);
        return $this->render('recipe/details.html.twig', [
            'recipe' => $recipe
        ]);
    }

    #[Route('/{kind}', name: '_by_kind')]
    public function byKind(string $kind): Response {
        $recipes = $this->recipeService->findByKind($kind);
        return $this->render('recipe/index.html.twig', [
            'recipeList' => $recipes,
            'kind' => $kind
        ]);
    }


}