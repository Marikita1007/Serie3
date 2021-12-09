<?php

namespace App\Controller;

use App\Entity\Series;
use App\Form\SerieType;
use App\Repository\SeriesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin/list", name="admin_list")
     */
    public function listAll(SeriesRepository $repository): Response
    {
        $series = $repository->findSeries();

        return $this->render('admin/dashboard.html.twig', [
            'series' => $series,
        ]);
    }

    /**
     * @Route("/admin/new", name="admin_new")
     */
    public function addSerie(EntityManagerInterface $manager, Request $request): Response
    {
        $serie = new Series();
        $form = $this->createForm(SerieType::class, $serie);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $manager->persist($serie);
            $manager->flush();
            $this->addFlash('success', 'Votre série a bien été ajouté !');
            return $this->redirectToRoute("admin_list");
        }
        return $this->render('admin/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/update/{id}", name="admin_update")
     */
    public function updateSerie(EntityManagerInterface $manager, Request $request, Series $serie): Response
    {
        $formUpdate = $this->createForm(SerieType::class, $serie);
        $formUpdate->handleRequest($request);
        if ($formUpdate->isSubmitted() && $formUpdate->isValid()){
            $manager->persist($serie);
            $manager->flush();
            $this->addFlash('success', 'Votre série a bien été modifiée !');
            return $this->redirectToRoute("admin_list");
        }
        return $this->render('admin/form.html.twig', [
            'formUpdate' => $formUpdate->createView(),
            'update' => true,
        ]);
    }

    /**
     * @Route("/admin/delete/{id}", name="admin_delete")
     */
    public function deleteSerie(EntityManagerInterface $manager, Request $request, Series $serie): Response
    {
        $manager->remove($serie);
        $manager->flush();
        $this->addFlash('success', 'Votre série a bien été supprimée');
        return $this->redirectToRoute("admin_list");

    }




}
