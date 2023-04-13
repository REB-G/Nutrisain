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
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

#[Route('/recipes')]
class RecipesController extends AbstractController
{
    #[Route('/', name: 'app_recipes_index', methods: ['GET', 'POST'])]
    public function index(
        RecipesRepository $recipesRepository,
        CategoriesRepository $categoriesRepository,
        DietsRepository $dietsRepository,
        Request $request
    ): Response
    {
        // Méthode pour effectuer une pagination (sans bundle)
        //Récuprère le numéro de page
        $page = (int)$request->query->get('page', 1);
        
        // Définition du nombre de recettes par page
        $limit = 3;

        // Méthode pour récupérer les filtres les sélectionnés par l'utilisateur
        $filtersCategories = $request->get('categories');
        $filtersDiets = $request->get('diets');
        // Récupération des recettes paginées et filtrées si des filtres sont sélectionnés
        $recipes = $recipesRepository->getPaginatedRecipes($page, $limit, $filtersCategories, $filtersDiets);

        // Récupération du nombre total de recettes
        $total = $recipesRepository->countRecipes($filtersCategories, $filtersDiets);
        // dd($filters, $recipes, $total);

        // Méthode pour proposer un filtrage sur les recettes par catégories et par régime.
        $categories = $categoriesRepository->findAll();
        $diets = $dietsRepository->findAll();

        //On vérifie si la requête est en AJAX
        if ($request->get('ajax')) {
            if (!$recipes) {
                return new JsonResponse([
                    'content' => $this->renderView('recipes/_no_recipes_found.html.twig'),
                ]);
            }
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


        return $this->render('recipes/index.html.twig', [
            'recipes' => $recipes,
            'total' => $total,
            'limit' => $limit,
            'page' => $page,
            'categories' => $categories,
            'diets' => $diets,
        ]);
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
        if ($this->isCsrfTokenValid('delete'.$recipe->getId(), $request->request->get('_token'))) {
            $recipesRepository->remove($recipe, true);
        }

        return $this->redirectToRoute('app_recipes_index', [], Response::HTTP_SEE_OTHER);
    }
}
