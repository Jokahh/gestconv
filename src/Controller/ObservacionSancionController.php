<?php

namespace App\Controller;

use App\Entity\ObservacionSancion;
use App\Form\ObservacionSancionType;
use App\Repository\ObservacionSancionRepository;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ObservacionSancionController extends AbstractController
{
    /**
     * @Route("/observacion_sancion", name="observacion_sancion_listar")
     */
    public function listar(ObservacionSancionRepository $observacionSancionRepository): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_USUARIO');
        $observacionesSanciones = $observacionSancionRepository->findAll();
        return $this->render('observacion_sancion/listar.html.twig', [
            'observacionesSanciones' => $observacionesSanciones
        ]);
    }

    /**
     * @Route ("/observacion_sancion/nuevo", name="observacion_sancion_nuevo")
     */
    public function nuevoObservacionSancion(Request $request, ObservacionSancionRepository $observacionSancionRepository): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_EDITOR');
        $observacionSancion = $observacionSancionRepository->nuevo();

        return $this->modificarObservacionSancion($request, $observacionSancionRepository, $observacionSancion);
    }

    /**
     * @Route("/observacion_sancion/{id}", name="observacion_sancion_modificar", requirements={"id":"\d+"})
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
                return $this->redirectToRoute('observacion_sancion_listar');
            } catch (Exception $e) {
                $this->addFlash('error', 'No se han podido guardar los cambios');
            }
        }
        return $this->render('observacion_sancion/modificar.html.twig', [
            'observacionSancion' => $observacionSancion,
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/observacion_sancion/eliminar/{id}", name="observacion_sancion_eliminar", requirements={"id":"\d+"})
     */
    public function eliminarObservacionSancion(Request $request, ObservacionSancionRepository $observacionSancionRepository, ObservacionSancion $observacionSancion): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_ADMIN');
        if ($request->request->has('confirmar')) {
            try {
                $observacionSancionRepository->eliminar($observacionSancion);
                $observacionSancionRepository->guardar();
                $this->addFlash('exito', 'Observación de sanción eliminada con éxito');
                return $this->redirectToRoute('observacion_sancion_listar');
            } catch (Exception $e) {
                $this->addFlash('error', '¡Ocurrió un error al eliminar la observación de sanción!');
            }
        }
        return $this->render('observacion_sancion/eliminar.html.twig', [
            'observacionSancion' => $observacionSancion
        ]);
    }
}
