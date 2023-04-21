<?php

namespace App\Controller;

use App\Entity\HomePage;
use App\Form\HomePageType;
use App\Repository\HomePageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/')]
class HomePageController extends AbstractController
{
    #[Route('/', name: 'app_home_page_index', methods: ['GET'])]
    public function index(HomePageRepository $homePageRepository): Response
    {
        return $this->render('home_page/index.html.twig', [
            'home_pages' => $homePageRepository->findAll(),
        ]);
    }

    #[Route('/{id}/edit', name: 'app_home_page_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, HomePage $homePage, HomePageRepository $homePageRepository): Response
    {
        $form = $this->createForm(HomePageType::class, $homePage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $homePageRepository->save($homePage, true);

            return $this->redirectToRoute('app_home_page_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('home_page/edit.html.twig', [
            'home_page' => $homePage,
            'form' => $form,
        ]);
    }
}
