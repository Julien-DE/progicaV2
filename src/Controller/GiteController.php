<?php

namespace App\Controller;

use App\Entity\Gite;
use App\Form\GiteType;
use App\Repository\GiteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/gite')]
class GiteController extends AbstractController
{
    #[Route('/', name: 'app_gite_index', methods: ['GET'])]
    public function index(GiteRepository $giteRepository): Response
    {
        return $this->render('gite/index.html.twig', [
            'gites' => $giteRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_gite_new', methods: ['GET', 'POST'])]
    public function new(Request $request, GiteRepository $giteRepository): Response
    {
        $gite = new Gite();
        $form = $this->createForm(GiteType::class, $gite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $giteRepository->save($gite, true);

            return $this->redirectToRoute('app_gite_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('gite/new.html.twig', [
            'gite' => $gite,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_gite_show', methods: ['GET'])]
    public function show(Gite $gite): Response
    {
        return $this->render('gite/show.html.twig', [
            'gite' => $gite,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_gite_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Gite $gite, GiteRepository $giteRepository): Response
    {
        $form = $this->createForm(GiteType::class, $gite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $giteRepository->save($gite, true);

            return $this->redirectToRoute('app_gite_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('gite/edit.html.twig', [
            'gite' => $gite,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_gite_delete', methods: ['POST'])]
    public function delete(Request $request, Gite $gite, GiteRepository $giteRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$gite->getId(), $request->request->get('_token'))) {
            $giteRepository->remove($gite, true);
        }

        return $this->redirectToRoute('app_gite_index', [], Response::HTTP_SEE_OTHER);
    }
}
