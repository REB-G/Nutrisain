<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\EditUserProfilType;
use App\Form\EditPasswordUserType;
use App\Repository\UsersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\SecurityBundle\Security\UserAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;

class UsersController extends AbstractController
{
    #[Route('/profil', name: 'app_users')]
    public function index(): Response
    {
        return $this->render('users/index.html.twig', [
            'controller_name' => 'UsersController',
        ]);
    }

    #[Route('/profil/mofidications', name: 'app_users_edit', methods: ['GET', 'POST'])]
    public function editProfile(Request $request, UsersRepository $usersRepository): Response
    {
        $user = $this->getUser();
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

    #[Route('/profil/ChangePassword', name: 'app_password_user_edit', methods: ['GET', 'POST'])]
    public function editPassword(
        Request $request,
        UserPasswordHasherInterface $userPasswordHasher,
        EntityManagerInterface $entityManager
    ): Response
    {
        $user = $this->getUser();
       // echo get_class($user);
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
            // $usersRepository->save($user, true);
            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('message', 'Mot de passe mis à jour');

            return $this->redirectToRoute('app_users', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('users/edit_user_profile.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }
}
