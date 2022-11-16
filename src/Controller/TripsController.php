<?php

namespace App\Controller;

use App\Entity\Trip;
use App\Form\TripType;
use App\Repository\TripRepository;
use Doctrine\ORM\EntityManagerInterface;
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
    public function list(TripRepository $tripRepository): Response
    {
        $trips = $tripRepository->findAll();

        return $this->render('trips/list.html.twig', [
            "trips" => $trips
        ]);
    }

    //affichage sortie
    /**
     * @Route("/details/{id}", name="details")
     */
    public function details(int $id, TripRepository $tripRepository): Response
    {
        $trip = $tripRepository->find($id);
        return $this->render('trips/details.html.twig', [
            "trip" => $trip
        ]);
    }

    //creation des sorties
    /**
     * @Route("/create", name="create")
     */
    public function create(): Response
    {
        //we associate the formType to trip entity
        $trip = new Trip();
        $tripForm = $this->createForm(TripType::class, $trip);
        return $this->render('trips/create.html.twig', [
            'tripForm' => $tripForm->createView(),
        ]);
    }

    /**
     * @Route("/demo", name="em-demo")
     */
    public function demo(EntityManagerInterface $entityManager): Response
    {
        //cree un instance de mon entite
        $trip = new Trip();

        //hydrate toutes les proprietes
        $trip->setNom('festival');
        $trip->setDateDebut(new \DateTime());
        $trip->setDuree(10);
        $trip->setMaxInscriptions(10);
        $trip->setDateLimiteInscription(new \DateTime());
        $trip->setEtat('Ec cours');
        $trip->setInfosSortie('tous au festival');

        dump($trip);

        $entityManager->persist($trip);
        $entityManager->flush();

        return $this->render('trips/create.html.twig');
    }
}
