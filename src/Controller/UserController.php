<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\EditPasswordType;
use App\Form\ProfileType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


/**
 * @Route("/profil", name="profil_")
 */
class UserController extends AbstractController
{


    /**
     * @Route("/edit", name="profil_edit")
     */
    public function editProfil(Request $request, EntityManagerInterface $em)
    {
        $user = $this->getUser();

        $form = $this->createForm(ProfileType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $user = new User();
            $em->persist($user);
            $em->flush();
            $this->addFlash('success', 'User modifiée !');

            return $this->redirectToRoute('profil_user');
        }

        return $this->render('user/edit.html.twig', [
            'formSave'=> $form->createView()
        ]);
    }

    /**
     * @Route("/modif", name="profil_modif")
     */

    public function editPassword(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordEncoder)
    {
        $user = $this->getUser();
        $form = $this->createForm(EditPasswordType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hash = $passwordEncoder->hashPassword($user, $form->get('new_password')->getData());
            $user->setPassword($hash);

            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('success', 'Mot de passe modifié !');
            $entityManager->refresh($user);

            return $this->redirectToRoute("profil_user", ["id" => $user->getId()]);
        }

        return $this->render('user/edit_password.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user")
     */
    public function profile(User $user): Response
    {

        return $this->render('user/profile.html.twig', [
            'user'=> $user
        ]);
    }
}



















