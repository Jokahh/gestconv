<?php

namespace App\Controller;

use App\Entity\ObservacionSancion;
use App\Form\ObservacionSancionType;
use App\Repository\ObservacionSancionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ObservacionSancionController extends AbstractController
{
    /**
     * @Route("/observacionSancion", name="observacionSancion_listar")
     */
    public function listar(ObservacionSancionRepository $observacionSancionRepository): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_USUARIO');
        $observacionesSanciones = $observacionSancionRepository->findAll();
        return $this->render('observacionSancion/listar.html.twig', [
            'observacionesSanciones' => $observacionesSanciones
        ]);
    }

    /**
     * @Route ("/observacionSancion/nuevo", name="observacionSancion_nuevo")
     */
    public function nuevoObservacionSancion(Request $request, ObservacionSancionRepository $observacionSancionRepository): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_EDITOR');
        $observacionSancion = $observacionSancionRepository->nuevo();

        return $this->modificarObservacionSancion($request, $observacionSancionRepository, $observacionSancion);
    }

    /**
     * @Route("/observacionSancion/{id}", name="observacionSancion_modificar")
     */
    public function modificarObservacionSancion(Request $request, ObservacionSancionRepository $observacionSancionRepository, ObservacionSancion $observacionSancion): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_EDITOR');
        $form = $this->createForm(ObservacionSancionType::class, $observacionSancion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $observacionSancionRepository->guardar();
                $this->addFlash('exito', 'Cambios guardados con éxito');
                return $this->redirectToRoute('observacionSancion_listar');
            } catch (\Exception $e) {
                $this->addFlash('error', 'No se han podido guardar los cambios');
            }
        }
        return $this->render('observacionSancion/modificar.html.twig', [
            'observacionSancion' => $observacionSancion,
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/observacionSancion/eliminar/{id}", name="observacionSancion_eliminar")
     */
    public function eliminarObservacionSancion(Request $request, ObservacionSancionRepository $observacionSancionRepository, ObservacionSancion $observacionSancion): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_ADMIN');
        if ($request->request->has('confirmar')) {
            try {
                $observacionSancionRepository->eliminar($observacionSancion);
                $observacionSancionRepository->guardar();
                $this->addFlash('exito', 'Observación de sanción eliminada con éxito');
                return $this->redirectToRoute('observacionSancion_listar');
            } catch (\Exception $e) {
                $this->addFlash('error', '¡Ocurrió un error al eliminar la observación de sanción!');
            }
        }
        return $this->render('observacionSancion/eliminar.html.twig', [
            'observacionSancion' => $observacionSancion
        ]);
    }
}
