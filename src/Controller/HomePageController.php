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

    #[Route('/new', name: 'app_home_page_new', methods: ['GET', 'POST'])]
    public function new(Request $request, HomePageRepository $homePageRepository): Response
    {
        $homePage = new HomePage();
        $form = $this->createForm(HomePageType::class, $homePage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $homePageRepository->save($homePage, true);

            return $this->redirectToRoute('app_home_page_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('home_page/new.html.twig', [
            'home_page' => $homePage,
            'form' => $form,
        ]);
    }

    // #[Route('/{id}', name: 'app_home_page_show', methods: ['GET'])]
    // public function show(HomePage $homePage): Response
    // {
    //     return $this->render('home_page/show.html.twig', [
    //         'home_page' => $homePage,
    //     ]);
    // }

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

    // #[Route('/{id}', name: 'app_home_page_delete', methods: ['POST'])]
    // public function delete(Request $request, HomePage $homePage, HomePageRepository $homePageRepository): Response
    // {
    //     if ($this->isCsrfTokenValid('delete'.$homePage->getId(), $request->request->get('_token'))) {
    //         $homePageRepository->remove($homePage, true);
    //     }

    //     return $this->redirectToRoute('app_home_page_index', [], Response::HTTP_SEE_OTHER);
    // }
}
