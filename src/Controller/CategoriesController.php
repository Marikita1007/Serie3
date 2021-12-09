<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Form\CategorieType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoriesController extends AbstractController
{
    /**
     * @Route("/categorie/new", name="categorie_new")
     */
    public function addCategorie(EntityManagerInterface $manager, Request $request): Response
    {
        $categories = new Categories();
        $formCategorie = $this->createForm(CategorieType::class,$categories );
        $formCategorie->handleRequest($request);
        if($formCategorie->isSubmitted() && $formCategorie->isValid()){
            $manager->persist($categories);
            $manager->flush();
            $this->addFlash('success', 'Votre categorie a bien été enregistrée');
            return $this->redirectToRoute('categorie_new');
        }
        return $this->render('categories/new.html.twig', [
            'formCategorie' => $formCategorie->createView(),
        ]);
    }
}
