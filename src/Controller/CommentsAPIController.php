<?php

namespace App\Controller;

use App\Entity\Opinions;
use App\Entity\Users;
use App\Entity\Recipes;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommentsAPIController extends AbstractController
{
    #[Route('/commentsApi', name: 'app_comments_api', methods: ['GET', 'POST'])]
    public function addComment(
        Request $request,
        ManagerRegistry $doctrine,
        EntityManagerInterface $entityManager
        ): JsonResponse {

        $entityManager = $doctrine->getManager();

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

        $recipe = $entityManager->getRepository(Recipes::class)->find($recipeId);
        $user = $entityManager->getRepository(Users::class)->find($userId);

        $opinion->setUser($user);
        $opinion->setRecipe($recipe);

        $entityManager->persist($opinion);
        $entityManager->flush();

        return new JsonResponse([
            'status' => 'ok',
            'message' => 'Commentaire ajouté avec succès',
        ]);
    }
}
