<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

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
            // do anything else you need here, like send an email

            $email = (new Email())
                ->from('nutrisain@gmail.com')
                ->to($user->getEmail())
                ->subject('Inscription à Nutrisain')
                ->html('Bonjour '.$user->getFirstname().',<br>
                <br>Vous avez été inscrit sur le site Nutrisain.<br>
                <br>Votre identifiant est : '.$user->getEmail().'<br>
                <br>Votre mot de passe est : '.$form->get('plainPassword')->getData().'<br>
                <br>Vous pouvez vous connecter sur le site en cliquant sur le lien suivant :
                <a href="http://localhost:8000/login">http://localhost:8000/login</a><br>
                <br>Merci de vous rendre sur votre espace et modifier votre mot de passe.<br>
                <br>Vous pouvez dès à présent prendre connaissance des recettes qui conviennent à votre régime et à vos allergies (si vous en avez) sur votre esapce.<br>
                <br>Vous trouverez l\'ensemble des recettes dans l\'onglet recettes.<br>
                <br>À bientôt,<br>
                <br>L\'équipe Nutrisain');

            $mailer->send($email);

            return $this->redirectToRoute('app_home_page_index');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
