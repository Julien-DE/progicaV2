<?php

namespace App\Controller;

use App\Entity\GiteEqpExt;
use App\Form\GiteEqpExtType;
use App\Repository\GiteEqpExtRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/gite/eqp/ext')]
class GiteEqpExtController extends AbstractController
{
    #[Route('/', name: 'app_gite_eqp_ext_index', methods: ['GET'])]
    public function index(GiteEqpExtRepository $giteEqpExtRepository): Response
    {
        return $this->render('gite_eqp_ext/index.html.twig', [
            'gite_eqp_exts' => $giteEqpExtRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_gite_eqp_ext_new', methods: ['GET', 'POST'])]
    public function new(Request $request, GiteEqpExtRepository $giteEqpExtRepository): Response
    {
        $giteEqpExt = new GiteEqpExt();
        $form = $this->createForm(GiteEqpExtType::class, $giteEqpExt);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $giteEqpExtRepository->save($giteEqpExt, true);

            return $this->redirectToRoute('app_gite_eqp_ext_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('gite_eqp_ext/new.html.twig', [
            'gite_eqp_ext' => $giteEqpExt,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_gite_eqp_ext_show', methods: ['GET'])]
    public function show(GiteEqpExt $giteEqpExt): Response
    {
        return $this->render('gite_eqp_ext/show.html.twig', [
            'gite_eqp_ext' => $giteEqpExt,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_gite_eqp_ext_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, GiteEqpExt $giteEqpExt, GiteEqpExtRepository $giteEqpExtRepository): Response
    {
        $form = $this->createForm(GiteEqpExtType::class, $giteEqpExt);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $giteEqpExtRepository->save($giteEqpExt, true);

            return $this->redirectToRoute('app_gite_eqp_ext_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('gite_eqp_ext/edit.html.twig', [
            'gite_eqp_ext' => $giteEqpExt,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_gite_eqp_ext_delete', methods: ['POST'])]
    public function delete(Request $request, GiteEqpExt $giteEqpExt, GiteEqpExtRepository $giteEqpExtRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$giteEqpExt->getId(), $request->request->get('_token'))) {
            $giteEqpExtRepository->remove($giteEqpExt, true);
        }

        return $this->redirectToRoute('app_gite_eqp_ext_index', [], Response::HTTP_SEE_OTHER);
    }
}
