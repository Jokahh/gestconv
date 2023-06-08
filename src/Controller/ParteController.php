<?php

namespace App\Controller;

use App\Entity\Parte;
use App\Form\ParteType;
use App\Repository\ParteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ParteController extends AbstractController
{
    /**
     * @Route("/parte", name="parte_listar")
     */
    public function listar(ParteRepository $parteRepository): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_USUARIO');
        $partes = $parteRepository->findAll();
        return $this->render('parte/listar.html.twig', [
            'partes' => $partes
        ]);
    }

    /**
     * @Route ("/parte/nuevo", name="parte_nuevo")
     */
    public function nuevoParte(Request $request, ParteRepository $parteRepository): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_EDITOR');
        $parte = $parteRepository->nuevo();
        
        return $this->modificarParte($request, $parteRepository, $parte);
    }

    /**
     * @Route("/parte/{id}", name="parte_modificar", requirements={"id":"\d+"})
     */
    public function modificarParte(Request $request, ParteRepository $parteRepository, Parte $parte): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_EDITOR');
        $parte->setFechaCreacion(new \DateTime());
        $form = $this->createForm(ParteType::class, $parte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $parteRepository->guardar();
                $this->addFlash('exito', 'Cambios guardados con éxito');
                return $this->redirectToRoute('parte_listar');
            } catch (\Exception $e) {
                $this->addFlash('error', 'No se han podido guardar los cambios');
            }
        }
        return $this->render('parte/modificar.html.twig', [
            'parte' => $parte,
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/parte/eliminar/{id}", name="parte_eliminar", requirements={"id":"\d+"})
     */
    public function eliminarParte(Request $request, ParteRepository $parteRepository, Parte $parte): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_ADMIN');
        if ($request->request->has('confirmar')) {
            try {
                $parteRepository->eliminar($parte);
                $parteRepository->guardar();
                $this->addFlash('exito', 'Parte eliminado con éxito');
                return $this->redirectToRoute('parte_listar');
            } catch (\Exception $e) {
                $this->addFlash('error', '¡Ocurrió un error al eliminar el parte!');
            }
        }
        return $this->render('parte/eliminar.html.twig', [
            'parte' => $parte
        ]);
    }
}
