<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InicioController extends AbstractController
{
    /**
     * @Route("/", name="inicio")
     */
    public function inicio(): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_USUARIO');
        return $this->render('inicio.html.twig');
    }
}
