<?php

namespace App\Controller;

use App\Entity\DemandeClient;
use App\Form\DemandeClientType;
use App\Repository\DemandeClientRepository;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[IsGranted("IS_AUTHENTICATED_FULLY")]
#[Route('/demande/client')]
final class DemandeClientController extends AbstractController
{
    #[Route(name: 'app_demande_client_index', methods: ['GET'])]
    public function index(DemandeClientRepository $demandeClientRepository, Request $request): Response
    {
        $all = $demandeClientRepository->findAll();

        $nbAcceptes    = count(array_filter($all, fn($d) => $d->getStatut() === 'accepte'));
        $nbNonAcceptes = count(array_filter($all, fn($d) => $d->getStatut() !== 'accepte'));

        $filtre = $request->query->get('statut');

        if ($filtre === 'accepte') {
            $demandes = array_values(array_filter($all, fn($d) => $d->getStatut() === 'accepte'));
        } elseif ($filtre === 'non_accepte') {
            $demandes = array_values(array_filter($all, fn($d) => $d->getStatut() !== 'accepte'));
        } else {
            $demandes = $all;
        }

        return $this->render('demande_client/index.html.twig', [
            'demande_clients' => $demandes,
            'nb_acceptes'     => $nbAcceptes,
            'nb_non_acceptes' => $nbNonAcceptes,
            'filtre_actif'    => $filtre,
        ]);
    }

    #[Route('/new', name: 'app_demande_client_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $demandeClient = new DemandeClient();
        $form = $this->createForm(DemandeClientType::class, $demandeClient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $demandeClient->setClient($this->getUser()); // 👈 associe le client connecté
            $entityManager->persist($demandeClient);
            $entityManager->flush();

            return $this->redirectToRoute('app_demande_client_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('demande_client/new.html.twig', [
            'demande_client' => $demandeClient,
            'form'           => $form,
        ]);
    }

    #[Route('/{id}/show', name: 'app_demande_client_show', methods: ['GET'])]
    public function show(DemandeClient $demandeClient): Response
    {
        return $this->render('demande_client/show.html.twig', [
            'demande_client' => $demandeClient,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_demande_client_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, DemandeClient $demandeClient, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DemandeClientType::class, $demandeClient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_demande_client_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('demande_client/edit.html.twig', [
            'demande_client' => $demandeClient,
            'form'           => $form,
        ]);
    }

    #[Route('/{id}/delete', name: 'app_demande_client_delete', methods: ['POST'])]
    public function delete(Request $request, DemandeClient $demandeClient, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $demandeClient->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($demandeClient);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_demande_client_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}/accepter', name: 'app_demande_client_accepter', methods: ['POST'])]
    public function accepter(DemandeClient $demandeClient, EntityManagerInterface $entityManager, Request $request): Response
    {
        if ($this->isCsrfTokenValid('accepter' . $demandeClient->getId(), $request->getPayload()->getString('_token'))) {
            $demandeClient->setStatut('accepte');
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_demande_client_index', [], Response::HTTP_SEE_OTHER);
    }
}