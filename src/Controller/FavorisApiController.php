<?php

namespace App\Controller;

use App\Repository\UsersRepository;
use App\Repository\RecipesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FavorisApiController extends AbstractController
{

    #[Route('/favorisApi', name: 'app_favoris_api', methods: ['GET', 'POST'])]
    public function addOrRemoveFavoris(
        Request $request,
        UsersRepository $usersRepository,
        RecipesRepository $recipesRepository,
    ): JsonResponse {

        $requestData = json_decode($request->getContent(), true);

        $userId = $requestData['user_id'];
        $recipeId = $requestData['recipe_id'];
        $action = $requestData['action'];

        $recipe = $recipesRepository->find($recipeId);
        $user = $usersRepository->find($userId);

        if ($action === 'add') {
            $user->addFavoriteRecipe($recipe);
            $usersRepository->save($user, true);
            return new JsonResponse(['content' => 'ok']);
        } elseif ($action === 'remove') {
            $user->removeFavoriteRecipe($recipe);
            $usersRepository->save($user, true);
            return new JsonResponse(['content' => 'ok']);
        } else {
            return new JsonResponse(['message' => 'Action invalide']);
        }
    }
}
