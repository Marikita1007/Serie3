<?php

namespace App\Controller;

use App\Repository\SeriesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="main_home")
     */
    public function index(SeriesRepository $repository): Response
    {
        $series = $repository->findSeries();

        return $this->render('main/list.html.twig', [
            'series' => $series,
        ]);
    }

    /**
     * @Route("/detail/{id}", name="main_detail")
     */
    public function details(SeriesRepository $repository, int $id): Response
    {
        $serie = $repository->find($id);

        return $this->render('main/detail.html.twig', [
            'serie' => $serie,
        ]);
    }
}
