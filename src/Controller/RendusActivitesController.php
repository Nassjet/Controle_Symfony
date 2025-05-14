<?php

namespace App\Controller;

use App\Entity\RendusActivites;
use App\Form\RendusActivitesForm;
use App\Repository\RendusActivitesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/rendus/activites')]
final class RendusActivitesController extends AbstractController
{
    #[Route(name: 'app_rendus_activites_index', methods: ['GET'])]
    public function index(RendusActivitesRepository $rendusActivitesRepository): Response
    {
        return $this->render('rendus_activites/index.html.twig', [
            'rendus_activites' => $rendusActivitesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_rendus_activites_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $rendusActivite = new RendusActivites();
        $form = $this->createForm(RendusActivitesForm::class, $rendusActivite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($rendusActivite);
            $entityManager->flush();

            return $this->redirectToRoute('app_rendus_activites_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('rendus_activites/new.html.twig', [
            'rendus_activite' => $rendusActivite,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_rendus_activites_show', methods: ['GET'])]
    public function show(RendusActivites $rendusActivite): Response
    {
        return $this->render('rendus_activites/show.html.twig', [
            'rendus_activite' => $rendusActivite,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_rendus_activites_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, RendusActivites $rendusActivite, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RendusActivitesForm::class, $rendusActivite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_rendus_activites_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('rendus_activites/edit.html.twig', [
            'rendus_activite' => $rendusActivite,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_rendus_activites_delete', methods: ['POST'])]
    public function delete(Request $request, RendusActivites $rendusActivite, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$rendusActivite->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($rendusActivite);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_rendus_activites_index', [], Response::HTTP_SEE_OTHER);
    }
}
