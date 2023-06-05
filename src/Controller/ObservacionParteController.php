<?php

namespace App\Controller;

use App\Entity\ObservacionParte;
use App\Form\ObservacionParteType;
use App\Repository\ObservacionParteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ObservacionParteController extends AbstractController
{
    /**
     * @Route("/observacion_parte", name="observacion_parte_listar")
     */
    public function listar(ObservacionParteRepository $observacionParteRepository): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_USUARIO');
        $observacionesPartes = $observacionParteRepository->findAll();
        return $this->render('observacion_parte/listar.html.twig', [
            'observacionesPartes' => $observacionesPartes
        ]);
    }

    /**
     * @Route ("/observacion_parte/nuevo", name="oobservacion_parte_nuevo")
     */
    public function nuevoObservacionParte(Request $request, ObservacionParteRepository $observacionParteRepository): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_EDITOR');
        $observacionParte = $observacionParteRepository->nuevo();

        return $this->modificarObservacionParte($request, $observacionParteRepository, $observacionParte);
    }

    /**
     * @Route("/observacion_parte/{id}", name="observacion_parte_modificar")
     */
    public function modificarObservacionParte(Request $request, ObservacionParteRepository $observacionParteRepository, ObservacionParte $observacionParte): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_EDITOR');
        $form = $this->createForm(ObservacionParteType::class, $observacionParte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $observacionParteRepository->guardar();
                $this->addFlash('exito', 'Cambios guardados con éxito');
                return $this->redirectToRoute('observacion_parte_listar');
            } catch (\Exception $e) {
                $this->addFlash('error', 'No se han podido guardar los cambios');
            }
        }
        return $this->render('observacion_parte/modificar.html.twig', [
            'observacionParte' => $observacionParte,
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/observacion_parte/eliminar/{id}", name="observacion_parte_eliminar")
     */
    public function eliminarObservacionParte(Request $request, ObservacionParteRepository $observacionParteRepository, ObservacionParte $observacionParte): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_ADMIN');
        if ($request->request->has('confirmar')) {
            try {
                $observacionParteRepository->eliminar($observacionParte);
                $observacionParteRepository->guardar();
                $this->addFlash('exito', 'Observacion de parte eliminada con éxito');
                return $this->redirectToRoute('observacion_parte_listar');
            } catch (\Exception $e) {
                $this->addFlash('error', '¡Ocurrió un error al eliminar la observación de parte!');
            }
        }
        return $this->render('observacion_parte/eliminar.html.twig', [
            'observacionParte' => $observacionParte
        ]);
    }
}
