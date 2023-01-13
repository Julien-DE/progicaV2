<?php

namespace App\Controller;

use App\Entity\GiteEqpInt;
use App\Form\GiteEqpIntType;
use App\Repository\GiteEqpIntRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/gite/eqp/int')]
class GiteEqpIntController extends AbstractController
{
    #[Route('/', name: 'app_gite_eqp_int_index', methods: ['GET'])]
    public function index(GiteEqpIntRepository $giteEqpIntRepository): Response
    {
        return $this->render('gite_eqp_int/index.html.twig', [
            'gite_eqp_ints' => $giteEqpIntRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_gite_eqp_int_new', methods: ['GET', 'POST'])]
    public function new(Request $request, GiteEqpIntRepository $giteEqpIntRepository): Response
    {
        $giteEqpInt = new GiteEqpInt();
        $form = $this->createForm(GiteEqpIntType::class, $giteEqpInt);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $giteEqpIntRepository->save($giteEqpInt, true);

            return $this->redirectToRoute('app_gite_eqp_int_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('gite_eqp_int/new.html.twig', [
            'gite_eqp_int' => $giteEqpInt,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_gite_eqp_int_show', methods: ['GET'])]
    public function show(GiteEqpInt $giteEqpInt): Response
    {
        return $this->render('gite_eqp_int/show.html.twig', [
            'gite_eqp_int' => $giteEqpInt,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_gite_eqp_int_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, GiteEqpInt $giteEqpInt, GiteEqpIntRepository $giteEqpIntRepository): Response
    {
        $form = $this->createForm(GiteEqpIntType::class, $giteEqpInt);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $giteEqpIntRepository->save($giteEqpInt, true);

            return $this->redirectToRoute('app_gite_eqp_int_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('gite_eqp_int/edit.html.twig', [
            'gite_eqp_int' => $giteEqpInt,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_gite_eqp_int_delete', methods: ['POST'])]
    public function delete(Request $request, GiteEqpInt $giteEqpInt, GiteEqpIntRepository $giteEqpIntRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$giteEqpInt->getId(), $request->request->get('_token'))) {
            $giteEqpIntRepository->remove($giteEqpInt, true);
        }

        return $this->redirectToRoute('app_gite_eqp_int_index', [], Response::HTTP_SEE_OTHER);
    }
}
