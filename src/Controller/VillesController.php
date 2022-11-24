<?php

namespace App\Controller;

use App\Entity\Villes;
use App\Form\VillesType;
use App\Repository\VillesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VillesController extends AbstractController
{
    /**
     * @Route("/villes", name="villes")
     */
    public function list(VillesRepository $vr): Response
    {
        $villes = $vr->findAll();

        return $this->render('villes/villes.html.twig', [
            'villes'=> $villes
        ]);
    }

    /**
     * @Route("/villes/add", name="add_villes")
     */

    public function add(Request $request, EntityManagerInterface $em)
    {
        $ville = new Villes();
        $form = $this->createForm(VillesType::class, $ville);
        $form -> handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($ville);
            $em->flush();
            $this->addFlash('success', 'Ville ajoutée !');
            return $this->redirectToRoute('villes');
        }

        return $this->render('villes/add.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/villes/{id}", name="edit_villes")
     */
    public function edit(Villes $ville, Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(VillesType::class, $ville);
        $form->remove('submit');
        $form->add('submit',SubmitType::class, [
            'label' => 'Modifier',
            'attr' => [
                'class' => 'btn btn-primary'
            ]
        ]);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $em->persist($ville);
            $em->flush();
            $this->addFlash('success', 'Ville modifiée !');

            return $this->redirectToRoute('villes');
        }

        return $this->render('villes/edit.html.twig', [
            'page_name' => 'Modification de la ville',
            'ville' => $ville,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/villes/delete/{id}", name="delete_ville")
     */
    public function delete(int $id, Request $request, VillesRepository $vr, EntityManagerInterface $em)
    {
        $ville = $vr->find($id);

        $em->remove($ville);
        $em->flush();
        $this->addFlash('success', 'La ville a été supprimée.');

        return $this->redirectToRoute('villes');
    }
}
