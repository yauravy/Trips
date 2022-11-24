<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/profil", name="profil_")
 */
class UserController extends AbstractController
{
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
