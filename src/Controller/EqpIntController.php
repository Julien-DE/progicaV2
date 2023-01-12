<?php

namespace App\Controller;

use App\Entity\EqpInt;
use App\Form\EqpIntType;
use App\Repository\EqpIntRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/eqp/int')]
class EqpIntController extends AbstractController
{
    #[Route('/', name: 'app_eqp_int_index', methods: ['GET'])]
    public function index(EqpIntRepository $eqpIntRepository): Response
    {
        return $this->render('eqp_int/index.html.twig', [
            'eqp_ints' => $eqpIntRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_eqp_int_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EqpIntRepository $eqpIntRepository): Response
    {
        $eqpInt = new EqpInt();
        $form = $this->createForm(EqpIntType::class, $eqpInt);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $eqpIntRepository->save($eqpInt, true);

            return $this->redirectToRoute('app_eqp_int_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('eqp_int/new.html.twig', [
            'eqp_int' => $eqpInt,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_eqp_int_show', methods: ['GET'])]
    public function show(EqpInt $eqpInt): Response
    {
        return $this->render('eqp_int/show.html.twig', [
            'eqp_int' => $eqpInt,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_eqp_int_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, EqpInt $eqpInt, EqpIntRepository $eqpIntRepository): Response
    {
        $form = $this->createForm(EqpIntType::class, $eqpInt);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $eqpIntRepository->save($eqpInt, true);

            return $this->redirectToRoute('app_eqp_int_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('eqp_int/edit.html.twig', [
            'eqp_int' => $eqpInt,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_eqp_int_delete', methods: ['POST'])]
    public function delete(Request $request, EqpInt $eqpInt, EqpIntRepository $eqpIntRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$eqpInt->getId(), $request->request->get('_token'))) {
            $eqpIntRepository->remove($eqpInt, true);
        }

        return $this->redirectToRoute('app_eqp_int_index', [], Response::HTTP_SEE_OTHER);
    }
}
