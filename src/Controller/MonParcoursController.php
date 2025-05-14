<?php

namespace App\Controller;

use App\Entity\Parcours;
use App\Entity\RendusActivites;
use App\Form\RendusActivitesType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MonParcoursController extends AbstractController
{
    #[Route('/mon-parcours', name: 'app_mon_parcours')]
    public function index(Request $request, EntityManagerInterface $em): Response
    {
        $user = $this->getUser();

        $parcours = $em->getRepository(Parcours::class)->findOneBy(['user' => $user]);

        if (!$parcours) {
            $this->addFlash('warning', 'Aucun parcours trouvé.');
            return $this->redirectToRoute('app_home');
        }

        $etapes = $parcours->getEtapes();

        // formulaire pour l'upload du rendu — optionnel si tu veux l'intégrer ici

        return $this->render('mon_parcours/index.html.twig', [
            'parcours' => $parcours,
            'etapes' => $etapes,
        ]);
    }
}
