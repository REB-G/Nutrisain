<?php

namespace App\Controller;

use App\Entity\Users;
use App\Entity\Recipes;
use App\Repository\RecipesRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FavorisApiController extends AbstractController
{

    #[Route('/favorisApi', name: 'app_favoris_api', methods: ['GET', 'POST'])]
    public function addOrRemoveFavoris(
        Request $request,
        ManagerRegistry $doctrine,
        EntityManagerInterface $entityManager
    ): JsonResponse {
        $entityManager = $doctrine->getManager();

        $requestData = json_decode($request->getContent(), true);

        $userId = $requestData['user_id'];
        $recipeId = $requestData['recipe_id'];
        $action = $requestData['action'];

        $recipe = $entityManager->getRepository(Recipes::class)->find($recipeId);
        $user = $entityManager->getRepository(Users::class)->find($userId);

        if ($action === 'add') {
            $user->addFavoriteRecipe($recipe);
            $entityManager->flush();
            return new JsonResponse(['content' => 'ok']);
        } elseif ($action === 'remove') {
            $user->removeFavoriteRecipe($recipe);
            $entityManager->flush();
            return new JsonResponse(['content' => 'ok']);
        } else {
            return new JsonResponse(['message' => 'Action invalide']);
        }
    }
}
