<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EtatsController extends AbstractController
{
    /**
     * @Route("/etats", name="app_etats")
     */
    public function index(): Response
    {
        return $this->render('etats/index.html.twig', [

        ]);
    }
}
