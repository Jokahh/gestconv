<?php

namespace App\Controller;

use App\Entity\Sancion;
use App\Form\SancionType;
use App\Repository\SancionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SancionController extends AbstractController
{
    /**
     * @Route("/sancion", name="sancion_listar")
     */
    public function listar(SancionRepository $sancionRepository): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_USUARIO');
        $sanciones = $sancionRepository->findAll();
        return $this->render('sancion/listar.html.twig', [
            'sanciones' => $sanciones
        ]);
    }

    /**
     * @Route ("/sancion/nuevo", name="sancion_nuevo")
     */
    public function nuevoSancion(Request $request, SancionRepository $sancionRepository): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_EDITOR');
        $sancion = $sancionRepository->nuevo();
        
        return $this->modificarSancion($request, $sancionRepository, $sancion);
    }

    /**
     * @Route("/sancion/{id}", name="sancion_modificar", requirements={"id":"\d+"})
     */
    public function modificarSancion(Request $request, SancionRepository $sancionRepository, Sancion $sancion): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_EDITOR');
        $form = $this->createForm(SancionType::class, $sancion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $sancionRepository->guardar();
                $this->addFlash('exito', 'Cambios guardados con éxito');
                return $this->redirectToRoute('sancion_listar');
            } catch (\Exception $e) {
                $this->addFlash('error', 'No se han podido guardar los cambios');
            }
        }
        return $this->render('sancion/modificar.html.twig', [
            'sancion' => $sancion,
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/sancion/eliminar/{id}", name="sancion_eliminar", requirements={"id":"\d+"})
     */
    public function eliminarSancion(Request $request, SancionRepository $sancionRepository, Sancion $sancion): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_ADMIN');
        if ($request->request->has('confirmar')) {
            try {
                $sancionRepository->eliminar($sancion);
                $sancionRepository->guardar();
                $this->addFlash('exito', 'Sanción eliminada con éxito');
                return $this->redirectToRoute('sancion_listar');
            } catch (\Exception $e) {
                $this->addFlash('error', '¡Ocurrió un error al eliminar la sanción!');
            }
        }
        return $this->render('sancion/eliminar.html.twig', [
            'sancion' => $sancion
        ]);
    }
}
