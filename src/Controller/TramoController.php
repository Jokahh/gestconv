<?php

namespace App\Controller;

use App\Entity\Tramo;
use App\Form\TramoType;
use App\Repository\TramoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TramoController extends AbstractController
{
    /**
     * @Route("/tramo", name="tramo_listar")
     */
    public function listar(TramoRepository $tramoRepository): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_USUARIO');
        $tramos = $tramoRepository->findAll();
        return $this->render('tramo/listar.html.twig', [
            'tramos' => $tramos
        ]);
    }

    /**
     * @Route ("/tramo/nuevo", name="tramo_nuevo")
     */
    public function nuevoTramo(Request $request, TramoRepository $tramoRepository): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_EDITOR');
        $tramo = $tramoRepository->nuevo();
        
        return $this->modificarTramo($request, $tramoRepository, $tramo);
    }

    /**
     * @Route("/tramo/{id}", name="tramo_modificar")
     */
    public function modificarTramo(Request $request, TramoRepository $tramoRepository, Tramo $tramo): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_EDITOR');
        $form = $this->createForm(TramoType::class, $tramo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $tramoRepository->guardar();
                $this->addFlash('exito', 'Cambios guardados con éxito');
                return $this->redirectToRoute('tramo_listar');
            } catch (\Exception $e) {
                $this->addFlash('error', 'No se han podido guardar los cambios');
            }
        }
        return $this->render('tramo/modificar.html.twig', [
            'tramo' => $tramo,
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/tramo/eliminar/{id}", name="tramo_eliminar")
     */
    public function eliminarTramo(Request $request, TramoRepository $tramoRepository, Tramo $tramo): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_ADMIN');
        if ($request->request->has('confirmar')) {
            try {
                $tramoRepository->eliminar($tramo);
                $tramoRepository->guardar();
                $this->addFlash('exito', 'Tramo eliminado con éxito');
                return $this->redirectToRoute('tramo_listar');
            } catch (\Exception $e) {
                $this->addFlash('error', '¡Ocurrió un error al eliminar el tramo!');
            }
        }
        return $this->render('tramo/eliminar.html.twig', [
            'tramo' => $tramo
        ]);
    }
}
