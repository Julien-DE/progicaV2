<?php

namespace App\Controller;

use App\Entity\GiteService;
use App\Form\GiteServiceType;
use App\Repository\GiteServiceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/gite/service')]
class GiteServiceController extends AbstractController
{
    #[Route('/', name: 'app_gite_service_index', methods: ['GET'])]
    public function index(GiteServiceRepository $giteServiceRepository): Response
    {
        return $this->render('gite_service/index.html.twig', [
            'gite_services' => $giteServiceRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_gite_service_new', methods: ['GET', 'POST'])]
    public function new(Request $request, GiteServiceRepository $giteServiceRepository): Response
    {
        $giteService = new GiteService();
        $form = $this->createForm(GiteServiceType::class, $giteService);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $giteServiceRepository->save($giteService, true);

            return $this->redirectToRoute('app_gite_service_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('gite_service/new.html.twig', [
            'gite_service' => $giteService,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_gite_service_show', methods: ['GET'])]
    public function show(GiteService $giteService): Response
    {
        return $this->render('gite_service/show.html.twig', [
            'gite_service' => $giteService,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_gite_service_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, GiteService $giteService, GiteServiceRepository $giteServiceRepository): Response
    {
        $form = $this->createForm(GiteServiceType::class, $giteService);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $giteServiceRepository->save($giteService, true);

            return $this->redirectToRoute('app_gite_service_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('gite_service/edit.html.twig', [
            'gite_service' => $giteService,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_gite_service_delete', methods: ['POST'])]
    public function delete(Request $request, GiteService $giteService, GiteServiceRepository $giteServiceRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$giteService->getId(), $request->request->get('_token'))) {
            $giteServiceRepository->remove($giteService, true);
        }

        return $this->redirectToRoute('app_gite_service_index', [], Response::HTTP_SEE_OTHER);
    }
}
