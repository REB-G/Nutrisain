<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\EditUserProfilType;
use App\Form\EditPasswordUserType;
use App\Repository\RecipesRepository;
use App\Repository\UsersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UsersController extends AbstractController
{
    #[Route('/profil', name: 'app_users')]
    public function index(RecipesRepository $recipesRepository): Response
    {
        $recipes = $recipesRepository->findAll();

        return $this->render('users/index.html.twig', [
            'recipes' => $recipes,
            'controller_name' => 'UsersController',
        ]);
    }

    #[Route('/profil/mofidications/{id}', name: 'app_users_edit', methods: ['GET', 'POST'])]
    public function editProfile(Request $request, UsersRepository $usersRepository, string $id): Response
    {
        $user = $this->getUser();
        $user = $this->getUser();
        if ($user->getId() !== $id) {
            throw $this->createAccessDeniedException();
        }

        $form = $this->createForm(EditUserProfilType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $usersRepository->save($user, true);

            $this->addFlash('message', 'Profil mis à jour');

            return $this->redirectToRoute('app_users', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('users/edit_user_profile.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/profil/edition/{id}', name: 'app_password_user_edit', methods: ['GET', 'POST'])]
    public function editPassword(
        Request $request,
        UserPasswordHasherInterface $userPasswordHasher,
        EntityManagerInterface $entityManager,
        string $id
    ): Response
    {
        $user = $this->getUser();
        if ($user->getId() !== $id) {
            throw $this->createAccessDeniedException();
        }

        $form = $this->createForm(EditPasswordUserType::class, $user);
        $form->handleRequest($request);
        

        if ($form->isSubmitted() && $form->isValid()
            && $request->request->get('edit_password_user')['plainPassword']['first']
            === $request->request->get('edit_password_user')['plainPassword']['second']
        ) {
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user, $request->request->get('edit_password_user')['plainPassword']['first']
                ));
            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('message', 'Mot de passe mis à jour');

            return $this->redirectToRoute('app_users', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('users/edit_password_user.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }
}
