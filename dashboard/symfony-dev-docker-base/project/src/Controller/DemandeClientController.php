<?php

namespace App\Controller;

use App\Entity\DemandeClient;
use App\Form\DemandeClientType;
use App\Repository\DemandeClientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/demande/client')]
final class DemandeClientController extends AbstractController
{
    #[Route(name: 'app_demande_client_index', methods: ['GET'])]
    public function index(DemandeClientRepository $demandeClientRepository): Response
    {
        return $this->render('demande_client/index.html.twig', [
            'demande_clients' => $demandeClientRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_demande_client_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $demandeClient = new DemandeClient();
        $form = $this->createForm(DemandeClientType::class, $demandeClient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($demandeClient);
            $entityManager->flush();

            return $this->redirectToRoute('app_demande_client_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('demande_client/new.html.twig', [
            'demande_client' => $demandeClient,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_demande_client_show', methods: ['GET'])]
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
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_demande_client_delete', methods: ['POST'])]
    public function delete(Request $request, DemandeClient $demandeClient, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$demandeClient->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($demandeClient);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_demande_client_index', [], Response::HTTP_SEE_OTHER);
    }
}
