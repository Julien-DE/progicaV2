<?php

namespace App\Controller;

use App\Entity\EqpExt;
use App\Form\EqpExtType;
use App\Repository\EqpExtRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/eqp/ext')]
class EqpExtController extends AbstractController
{
    #[Route('/', name: 'app_eqp_ext_index', methods: ['GET'])]
    public function index(EqpExtRepository $eqpExtRepository): Response
    {
        return $this->render('eqp_ext/index.html.twig', [
            'eqp_exts' => $eqpExtRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_eqp_ext_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EqpExtRepository $eqpExtRepository): Response
    {
        $eqpExt = new EqpExt();
        $form = $this->createForm(EqpExtType::class, $eqpExt);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $eqpExtRepository->save($eqpExt, true);

            return $this->redirectToRoute('app_eqp_ext_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('eqp_ext/new.html.twig', [
            'eqp_ext' => $eqpExt,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_eqp_ext_show', methods: ['GET'])]
    public function show(EqpExt $eqpExt): Response
    {
        return $this->render('eqp_ext/show.html.twig', [
            'eqp_ext' => $eqpExt,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_eqp_ext_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, EqpExt $eqpExt, EqpExtRepository $eqpExtRepository): Response
    {
        $form = $this->createForm(EqpExtType::class, $eqpExt);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $eqpExtRepository->save($eqpExt, true);

            return $this->redirectToRoute('app_eqp_ext_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('eqp_ext/edit.html.twig', [
            'eqp_ext' => $eqpExt,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_eqp_ext_delete', methods: ['POST'])]
    public function delete(Request $request, EqpExt $eqpExt, EqpExtRepository $eqpExtRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$eqpExt->getId(), $request->request->get('_token'))) {
            $eqpExtRepository->remove($eqpExt, true);
        }

        return $this->redirectToRoute('app_eqp_ext_index', [], Response::HTTP_SEE_OTHER);
    }
}
