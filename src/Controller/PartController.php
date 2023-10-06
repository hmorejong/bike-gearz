<?php

namespace App\Controller;

use App\Entity\Part;
use App\Form\PartFormType;
use App\Repository\PartRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/part')]
class PartController extends AbstractController
{
    #[Route('/parts', name: 'app_part_index', methods: ['GET'])]
    public function index(PartRepository $partRepository): Response
    {
        return $this->render('part/index.html.twig', [
            'parts' => $partRepository->findAll(),
        ]);
    }

    #[Route('/new-part', name: 'app_part_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $part = new Part();
        $form = $this->createForm(PartFormType::class, $part);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($part);
            $entityManager->flush();

            return $this->redirectToRoute('app_part_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('part/new.html.twig', [
            'part' => $part,
            'form' => $form,
        ]);
    }

    #[Route('/part/{id}/show', name: 'app_part_show', methods: ['GET'])]
    public function show(Part $part): Response
    {
        return $this->render('part/show.html.twig', [
            'part' => $part,
        ]);
    }

    #[Route('/part/{id}/edit', name: 'app_part_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Part $part, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PartFormType::class, $part);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_part_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('part/edit.html.twig', [
            'part' => $part,
            'form' => $form,
        ]);
    }

    #[Route('/bike/{id}/delete', name: 'app_part_delete', methods: ['POST'])]
    public function delete(Request $request, Part $part, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$part->getId(), $request->request->get('_token'))) {
            $entityManager->remove($part);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_part_index', [], Response::HTTP_SEE_OTHER);
    }
}