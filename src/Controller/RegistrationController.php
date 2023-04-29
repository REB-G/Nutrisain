<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\EditUserProfilType;
use App\Form\FirstConnexionUserType;
use Symfony\Component\Mime\Email;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegistrationController extends AbstractController
{
    #[Route('/ajout-patient', name: 'app_register')]
    public function register(
        Request $request,
        UserPasswordHasherInterface $userPasswordHasher,
        EntityManagerInterface $entityManager,
        MailerInterface $mailer
        ): Response
    {
        if (!$this->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException('Accès refusé.');
        }
        
        $user = new Users();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager->persist($user);
            $entityManager->flush();

            $idUser = $user->getId();
            
            $email = (new TemplatedEmail())
                ->from('nutrisain@gmail.com')
                ->to($user->getEmail())
                ->subject('Inscription à Nutrisain')
                ->htmlTemplate('registration/email_registration.html.twig')
                ->context([
                    'user' => $user,
                    'url' => $this->generateUrl('app_first_connexion', ['id' => $idUser]),
                    'expiration_date' => new \DateTime('+7 days'),
                ]);

            $mailer->send($email);

            return $this->redirectToRoute('app_home_page_index');
            $this->addFlash('success', 'Le patient a bien été ajouté et le mail a bien été envoyé.');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    #[Route('/initialisation/compte/{id}', name: 'app_first_connexion')]
    public function firstConnexion(
        Request $request,
        UserPasswordHasherInterface $userPasswordHasher,
        EntityManagerInterface $entityManager,
        string $id
        ): Response
    {
        $user = $this->getUser();
        // if ($user->getId() !== $id) {
        //     throw $this->createAccessDeniedException();
        // }

        $form = $this->createForm(FirstConnexionUserType::class, $user);
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

        return $this->render('registration/first_connexion.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
}
