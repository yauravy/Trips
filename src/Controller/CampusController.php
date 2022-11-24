<?php

namespace App\Controller;

use App\Entity\Campus;
use App\Form\CampusType;
use App\Repository\CampusRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CampusController extends AbstractController
{
    /**
     * @Route("/campus", name="campus_list")
     */
    public function list(CampusRepository $campusRepository): Response
    {
        $campus = $campusRepository->findAll();
        return $this->render('campus/list.html.twig', [
            'campus'=> $campus
        ]);
    }

    /**
     * @Route("/campus/add", name="campus_add")
     */
    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
        $campus = new Campus();
        $form = $this->createForm(CampusType::class, $campus);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $entityManager->persist($campus);
            $entityManager->flush();

            $this->addFlash('success', 'Campus added!');
            return $this->redirectToRoute('campus_list');
        }


        return $this->render('campus/add.html.twig', [
            'campus'=> $campus,
            "form"=> $form->createView()
        ]);
    }

    /**
     * @Route("/campus/{id}", name="campus_edit")
     */

    public function edit(campus $campus,Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CampusType::class, $campus);
        $form->remove('submit');
        $form->add('submit', SubmitType::class, [
            'label' => 'Modif',
            'attr' => [
                'class'=> 'btn-primary'
            ]
        ]);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($campus);
            $entityManager->flush();
            $this->addFlash('success', 'campus modifie');

            return $this->redirectToRoute('campus_list');
        }

        return $this->render('campus/edit.html.twig', [
            "campus" => $campus,
            'form'=> $form->createView()
        ]);
    }


    /**
     * @Route("/campus/delete/{id}", name="campus_delete")
     */

    public function delete(int $id, Request $request, CampusRepository $cr, EntityManagerInterface $em)
    {
        $campus = $cr->find($id);

        $em->remove($campus);
        $em->flush();
        $this->addFlash('success', 'campus deleted');

        return $this->redirectToRoute('campus_list');
    }
}















