<?php

namespace App\Controller;

use App\Entity\Recipes;
use App\Form\RecipesType;
use App\Repository\DietsRepository;
use App\Repository\RecipesRepository;
use App\Repository\CategoriesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/recipes')]
class RecipesController extends AbstractController
{
    #[Route('/', name: 'app_recipes_index', methods: ['GET', 'POST'])]
    public function index(
        RecipesRepository $recipesRepository,
        CategoriesRepository $categoriesRepository,
        DietsRepository $dietsRepository,
        Request $request
    ): Response {

        $page = (int)$request->query->get('page', 1);

        $limit = 3;

        $filtersCategories = $request->get('categories');
        $filtersDiets = $request->get('diets');
        $recipes = $recipesRepository->getPaginatedRecipes($page, $limit, $filtersCategories, $filtersDiets);
        $allRecipes = $recipesRepository->getPaginatedAllRecipes($page, $limit, $filtersCategories, $filtersDiets);

        $total = $recipesRepository->countRecipes($filtersCategories, $filtersDiets);
        $totalForAllRecipes = $recipesRepository->countAllRecipes($filtersCategories, $filtersDiets);

        $categories = $categoriesRepository->findAll();
        $diets = $dietsRepository->findAll();

        if ($request->get('ajax')) {
            if (!$recipes) {
                return new JsonResponse([
                    'content' => $this->renderView('recipes/_no_recipes_found.html.twig'),
                ]);
            }

            if ($this->isGranted('IS_AUTHENTICATED_FULLY')) {
                return new JsonResponse([
                    'content' => $this->renderView('recipes/_recipes.html.twig', [
                        'allRecipes' => $allRecipes,
                        'totalForAllRecipes' => $totalForAllRecipes,
                        'limit' => $limit,
                        'page' => $page,
                        'categories' => $categories,
                        'diets' => $diets,
                    ]),
                ]);
            } else {
                return new JsonResponse([
                    'content' => $this->renderView('recipes/_recipes.html.twig', [
                        'recipes' => $recipes,
                        'total' => $total,
                        'limit' => $limit,
                        'page' => $page,
                        'categories' => $categories,
                        'diets' => $diets,
                    ]),
                ]);
            }
        }

        if ($this->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->render('recipes/index.html.twig', [
                'allRecipes' => $allRecipes,
                'totalForAllRecipes' => $totalForAllRecipes,
                'limit' => $limit,
                'page' => $page,
                'categories' => $categories,
                'diets' => $diets,
            ]);
        } else {
            // Rendu pour un utilisateur non connecté
            return $this->render('recipes/index.html.twig', [
                'recipes' => $recipes,
                'total' => $total,
                'limit' => $limit,
                'page' => $page,
                'categories' => $categories,
                'diets' => $diets,
            ]);
        }

    }

    #[Route('/new', name: 'app_recipes_new', methods: ['GET', 'POST'])]
    public function new(Request $request, RecipesRepository $recipesRepository): Response
    {
        $recipe = new Recipes();
        $form = $this->createForm(RecipesType::class, $recipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $recipesRepository->save($recipe, true);

            return $this->redirectToRoute('app_recipes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('recipes/new.html.twig', [
            'recipe' => $recipe,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_recipes_show', methods: ['GET'])]
    public function show(Recipes $recipe): Response
    {
        return $this->render('recipes/show.html.twig', [
            'recipe' => $recipe,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_recipes_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Recipes $recipe, RecipesRepository $recipesRepository): Response
    {
        $form = $this->createForm(RecipesType::class, $recipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $recipesRepository->save($recipe, true);

            return $this->redirectToRoute('app_recipes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('recipes/edit.html.twig', [
            'recipe' => $recipe,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_recipes_delete', methods: ['POST'])]
    public function delete(Request $request, Recipes $recipe, RecipesRepository $recipesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $recipe->getId(), $request->request->get('_token'))) {
            $recipesRepository->remove($recipe, true);
        }

        return $this->redirectToRoute('app_recipes_index', [], Response::HTTP_SEE_OTHER);
    }
}
