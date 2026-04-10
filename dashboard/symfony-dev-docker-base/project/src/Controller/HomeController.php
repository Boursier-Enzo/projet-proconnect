<?php

namespace App\Controller;

use App\Repository\DemandeClientRepository;
use App\Repository\UserRepository;
use App\Repository\ProjetRepository;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
#[IsGranted("IS_AUTHENTICATED_FULLY")]
final class HomeController extends AbstractController
{
    #[Route("/", name: "app_home")]
    public function index(
        DemandeClientRepository $demandeRepo,
        UserRepository $userRepo,
        ProjetRepository $projetRepo,
    ): Response {
        // Récupération des données pour le dashboard
        return $this->render("home/index.html.twig", [
            // Compteurs pour les badges d'information
            "total_demandes" => $demandeRepo->count([]),
            "total_clients" => $userRepo->count([]),
            "total_projets" => $projetRepo->count([]),

            // Liste des dernières demandes reçues via le Portail Client
            "dernieres_demandes" => $demandeRepo->findBy(
                [],
                ["id" => "DESC"],
                5,
            ),

            // Les projets/dossiers urgents
            "projets_recents" => $projetRepo->findBy([], ["id" => "DESC"], 3),
        ]);
    }
}
