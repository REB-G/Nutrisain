<?php

namespace App\Controller;

use App\Entity\Opinions;
use App\Repository\UsersRepository;
use App\Repository\RecipesRepository;
use App\Repository\OpinionsRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommentsAPIController extends AbstractController
{
    #[Route('/commentsApi', name: 'app_comments_api', methods: ['GET', 'POST'])]
    public function addComment(
        Request $request,
        OpinionsRepository $opinionsRepository,
        RecipesRepository $recipesRepository,
        UsersRepository $usersRepository,
        ): JsonResponse {

        $requestData = $request->request->all();
        $comment = $requestData['comment'];
        $userId = $requestData['userId'];
        $userName = $requestData['userName'];
        $userFirstname = $requestData['userFirstname'];
        $recipeId = $requestData['recipeId'];

        $opinion = new Opinions();
        $opinion->setComment($comment);
        $opinion->setUserName($userName);
        $opinion->setUserFirstname($userFirstname);

        $recipe = $recipesRepository->find($recipeId);
        $user = $usersRepository->find($userId);

        $opinion->setUser($user);
        $opinion->setRecipe($recipe);

        $opinionsRepository->save($opinion, true);

        return new JsonResponse([
            'status' => 'ok',
            'message' => 'Commentaire ajouté avec succès',
        ]);
    }
}
