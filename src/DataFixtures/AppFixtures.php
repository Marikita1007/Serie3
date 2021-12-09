<?php

namespace App\DataFixtures;

use App\Entity\Series;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $serie1 = new Series();
        $serie1->setNom('Dragons les gardiens du ciel')
            ->setSynopsis('Dragons: Les Gardiens du Ciel est une série télévisée américaine animée par ordinateur dans la franchise Dragons produite par DreamWorks Animation Television pour Netflix.')
            ->setPoster('img/dragons.jpg')
            ->setGenre('Animation');
         $manager->persist($serie1);

        $serie2 = new Series();
        $serie2->setNom('the Walking Dead')
            ->setSynopsis("Une épidémie a transformé presque tous les êtres humains en zombies. Rick Grimes, un shérif-adjoint, prend la tête d\'un groupe d\'hommes et de femmes qui tentent de survivre tant bien que mal dans ce nouvel univers hostile")
            ->setPoster('img/walking_dead.jpg')
            ->setGenre('Fiction');
        $manager->persist($serie2);

        $serie3 = new Series();
        $serie3->setNom('Casa del Papel')
            ->setSynopsis('La casa de papel, ou La Maison de papier au Québec, est une série télévisée espagnole créée par Álex Pina et diffusée entre le 2 mai 2017 et le 23 novembre 2017 sur la chaîne Antena 3 en Espagne.')
            ->setPoster('img/casa.jpg')
            ->setGenre('Thriller');
        $manager->persist($serie3);

        $manager->flush();
    }
}
