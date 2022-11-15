<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/trips", name="trips_")
 */
class TripsController extends AbstractController
{
    // list sorties
    /**
     * @Route("", name="list")
     */
    public function list(): Response
    {
        return $this->render('trips/list.html.twig', [
            'controller_name' => 'TripsController',
        ]);
    }

    //affichage sortie
    /**
     * @Route("/details/{id}", name="details")
     */
    public function details(int $id): Response
    {
        return $this->render('trips/details.html.twig', [
            'controller_name' => 'TripsController',
        ]);
    }

    //creation des sorties
    /**
     * @Route("/create", name="create")
     */
    public function create(): Response
    {
        return $this->render('trips/create.html.twig', [
            'controller_name' => 'TripsController',
        ]);
    }
}
