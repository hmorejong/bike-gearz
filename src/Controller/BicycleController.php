<?php

namespace App\Controller;

use App\Entity\Bicycle;
use App\Entity\Part;
use App\Form\BicycleFormType;
use App\Form\PartFormType;
use App\Repository\BicycleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/bike')]
class BicycleController extends AbstractController
{
    #[Route('/bikes', name: 'app_bicycle_index', methods: ['GET'])]
    public function index(BicycleRepository $bicycleRepository): Response
    {
        return $this->render('bicycle/index.html.twig', [
            'bicycles' => $bicycleRepository->findAll(),
        ]);
    }

    #[Route('/new-bike', name: 'app_bicycle_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $bicycle = new Bicycle();
        $form = $this->createForm(BicycleFormType::class, $bicycle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($bicycle);
            $em->flush();

            return $this->redirectToRoute('app_bicycle_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('bicycle/new.html.twig', [
            'bicycle' => $bicycle,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/show', name: 'app_bicycle_show', methods: ['GET'])]
    public function show(Bicycle $bicycle): Response
    {
        return $this->render('bicycle/show.html.twig', [
            'bicycle' => $bicycle,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_bicycle_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request,
                         Bicycle $bicycle,
                         EntityManagerInterface $em): Response
    {
        $form = $this->createForm(BicycleFormType::class, $bicycle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            return $this->redirectToRoute('app_bicycle_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('bicycle/edit.html.twig', [
            'bicycle' => $bicycle,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/delete', name: 'app_bicycle_delete', methods: ['POST'])]
    public function delete(Request $request,
                           Bicycle $bicycle,
                           BicycleRepository $bicycleRepository,
                           EntityManagerInterface $em): Response
    {

        if ($this->isCsrfTokenValid('delete' . $bicycle->getId(), $request->request->get('_token'))) {
            $bicycleRepository->removeAssociations($bicycle);

            $em->remove($bicycle);
            $em->flush();
        }

        return $this->redirectToRoute('app_bicycle_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/new-part/{id}/bike', name: 'app_new_part_bicycle', methods: ['GET', 'POST'])]
    public function addPartToBike(Request $request,
                                  Bicycle $bicycle,
                                  EntityManagerInterface $em): Response
    {
        $part = new Part();
        $form = $this->createForm(PartFormType::class, $part);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $part->setBicycle($bicycle);
            $em->persist($part);
            $em->flush();

            return $this->redirectToRoute('app_bicycle_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('part/new.html.twig', [
            'part' => $part,
            'form' => $form,
        ]);
    }
}