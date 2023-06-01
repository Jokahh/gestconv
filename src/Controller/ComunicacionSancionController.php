<?php

namespace App\Controller;

use App\Entity\ComunicacionSancion;
use App\Form\ComunicacionSancionType;
use App\Repository\ComunicacionSancionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ComunicacionSancionController extends AbstractController
{
    /**
     * @Route("/comunicacionSancion", name="comunicacionSancion_listar")
     */
    public function listar(ComunicacionSancionRepository $comunicacionSancionRepository): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_USUARIO');
        $comunicacionesSanciones = $comunicacionSancionRepository->findAll();
        return $this->render('comunicacionSancion/listar.html.twig', [
            'comunicacionesSanciones' => $comunicacionesSanciones
        ]);
    }

    /**
     * @Route ("/comunicacionSancion/nuevo", name="comunicacionSancion_nuevo")
     */
    public function nuevoComunicacionSancion(Request $request, ComunicacionSancionRepository $comunicacionSancionRepository): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_EDITOR');
        $comunicacionSancion = $comunicacionSancionRepository->nuevo();

        return $this->modificarComunicacionSancion($request, $comunicacionSancionRepository, $comunicacionSancion);
    }

    /**
     * @Route("/comunicacionSancion/{id}", name="comunicacionSancion_modificar")
     */
    public function modificarComunicacionSancion(Request $request, ComunicacionSancionRepository $comunicacionSancionRepository, ComunicacionSancion $comunicacionSancion): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_EDITOR');
        $form = $this->createForm(ComunicacionSancionType::class, $comunicacionSancion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $comunicacionSancionRepository->guardar();
                $this->addFlash('exito', 'Cambios guardados con éxito');
                return $this->redirectToRoute('comunicacionSancion_listar');
            } catch (\Exception $e) {
                $this->addFlash('error', 'No se han podido guardar los cambios');
            }
        }
        return $this->render('comunicacionSancion/modificar.html.twig', [
            'comunicacionSancion' => $comunicacionSancion,
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/comunicacionSancion/eliminar/{id}", name="comunicacionSancion_eliminar")
     */
    public function eliminarComunicacionSancion(Request $request, ComunicacionSancionRepository $comunicacionSancionRepository, ComunicacionSancion $comunicacionSancion): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_ADMIN');
        if ($request->request->has('confirmar')) {
            try {
                $comunicacionSancionRepository->eliminar($comunicacionSancion);
                $comunicacionSancionRepository->guardar();
                $this->addFlash('exito', 'Comunicacion de sanción eliminada con éxito');
                return $this->redirectToRoute('comunicacionSancion_listar');
            } catch (\Exception $e) {
                $this->addFlash('error', '¡Ocurrió un error al eliminar la comunicación de sanción!');
            }
        }
        return $this->render('comunicacionSancion/eliminar.html.twig', [
            'comunicacionSancion' => $comunicacionSancion
        ]);
    }
}
