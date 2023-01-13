<?php

namespace App\Controller;


use App\Entity\Gite;
use App\Entity\GiteEqpExt;
use App\Entity\GiteEqpInt;
use App\Entity\GiteService;
use App\Form\GiteType;
use App\Repository\GiteRepository;
use Doctrine\ORM\EntityManagerInterface;
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
    public function new(Request $request, GiteRepository $giteRepository,EntityManagerInterface $entityManager):Response
    {
        $gite = new Gite();

        $service = new GiteService();
        
        $gite->addGiteService($service);
        
        
        $eqpExt = new GiteEqpExt();
        $gite->addGiteEqpExt($eqpExt);

        $eqpInt = new GiteEqpInt();
        $gite->addGiteEqpInt($eqpInt);
    

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
