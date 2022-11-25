<?php

namespace App\Controller;

use App\Entity\Trip;
use App\Form\TripType;
use App\Repository\TripRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;

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
            "trips" => $trips,
        ]);
    }

    //affichage sortie
    /**
     * @Route("/details/{id}", name="details")
     */
    public function details(int $id, TripRepository $tripRepository): Response
    {
        $trip = $tripRepository->find($id);

        $trip->getInscriptions();
        return $this->render('trips/details.html.twig', [
            "trip" => $trip
        ]);
    }

    //creation des sorties
    /**
     * @Route("/create", name="create")
     */
    public function create(EntityManagerInterface $entityManager,Request $request): Response
    {
        //we associate the formType to trip entity
        $trip = new Trip();
        $tripForm = $this->createForm(TripType::class, $trip);

        //dump($trip);
        $tripForm->handleRequest($request);
        //dump($trip);

        if($tripForm->isSubmitted() && $tripForm->isValid()){
            //$trip->setDateDebut(new \DateTime());

                $trip->setEtat("En creation");


            $trip->setCreator($this->getUser());
            $entityManager->persist($trip);
            $entityManager->flush();

            $this->addFlash('success', 'Sortie Ajouté');
            return $this->redirectToRoute('trips_details', ['id' => $trip->getId()]);
        }

        return $this->render('trips/create.html.twig', [
            'tripForm' => $tripForm->createView(),
        ]);
    }

}
