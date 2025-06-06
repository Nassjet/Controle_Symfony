<?php

namespace App\Controller;

use App\Entity\Parcours;
use App\Form\ParcoursForm;
use App\Repository\ParcoursRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/parcours')]
final class ParcoursController extends AbstractController
{
    #[Route(name: 'app_parcours_index', methods: ['GET'])]
    public function index(ParcoursRepository $parcoursRepository): Response
    {
        return $this->render('parcours/index.html.twig', [
            'parcours' => $parcoursRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_parcours_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $parcours = new Parcours();
        $form = $this->createForm(ParcoursForm::class, $parcours);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($parcours);
            $entityManager->flush();

            return $this->redirectToRoute('app_parcours_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('parcours/new.html.twig', [
            'parcours' => $parcours,
            'form' => $form,
        ]);
    }

    #[Route('/parcours/{id}', name: 'app_parcours_show')]
    // #[IsGranted('ROLE_USER')]
    public function show(Parcours $parcours): Response
    {
        // Vérifie que l'utilisateur a le droit d'accéder à ce parcours
        // if ($parcours->getUser() !== $this->getUser()) {
        //     throw $this->createAccessDeniedException();
        // }

        return $this->render('parcours/show.html.twig', [
            'parcours' => $parcours,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_parcours_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Parcours $parcours, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ParcoursForm::class, $parcours);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_parcours_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('parcours/edit.html.twig', [
            'parcours' => $parcours,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_parcours_delete', methods: ['POST'])]
    public function delete(Request $request, Parcours $parcours, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $parcours->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($parcours);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_parcours_index', [], Response::HTTP_SEE_OTHER);
    }
}
