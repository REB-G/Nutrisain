<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LegalsController extends AbstractController
{
    #[Route('/mentions-legales', name: 'app_legal_notice')]
    public function legalNotice(): Response
    {
        return $this->render('legals/legal_notice.html.twig', [
            'controller_name' => 'LegalsController',
        ]);
    }

    #[Route('/politique-de-confidentialité', name: 'app_privacy_policy')]
    public function privacyPolicy(): Response
    {
        return $this->render('legals/privacy_policy.html.twig', [
            'controller_name' => 'LegalsController',
        ]);
    }

    #[Route('/conditions-générales-d\'utilisation', name: 'app_terms_of_use')]
    public function termsOfService(): Response
    {
        return $this->render('legals/terms_of_use.html.twig', [
            'controller_name' => 'LegalsController',
        ]);
    }
}
