<?php

namespace App\Controller;

use App\Entity\TipoComunicacion;
use App\Form\TipoComunicacionType;
use App\Repository\TipoComunicacionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TipoComunicacionController extends AbstractController
{
    /**
     * @Route("/tipoComunicacion", name="tipoComunicacion_listar")
     */
    public function listar(TipoComunicacionRepository $tipoComunicacionRepository): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_USUARIO');
        $tiposComunicaciones = $tipoComunicacionRepository->findAll();
        return $this->render('tipoComunicacion/listar.html.twig', [
            'tiposComunicaciones' => $tiposComunicaciones
        ]);
    }

    /**
     * @Route ("/tipoComunicacion/nuevo", name="tipoComunicacion_nuevo")
     */
    public function nuevoTipoComunicacion(Request $request, TipoComunicacionRepository $tipoComunicacionRepository): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_EDITOR');
        $tipoComunicacion = $tipoComunicacionRepository->nuevo();

        return $this->modificarTipoComunicacion($request, $tipoComunicacionRepository, $tipoComunicacion);
    }

    /**
     * @Route("/tipoComunicacion/{id}", name="tipoComunicacion_modificar")
     */
    public function modificarTipoComunicacion(Request $request, TipoComunicacionRepository $tipoComunicacionRepository, TipoComunicacion $tipoComunicacion): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_EDITOR');
        $form = $this->createForm(TipoComunicacionType::class, $tipoComunicacion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $tipoComunicacionRepository->guardar();
                $this->addFlash('exito', 'Cambios guardados con éxito');
                return $this->redirectToRoute('tipoComunicacion_listar');
            } catch (\Exception $e) {
                $this->addFlash('error', 'No se han podido guardar los cambios');
            }
        }
        return $this->render('tipoComunicacion/modificar.html.twig', [
            'tipoComunicacion' => $tipoComunicacion,
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/tipoComunicacion/eliminar/{id}", name="tipoComunicacion_eliminar")
     */
    public function eliminarTipoComunicacion(Request $request, TipoComunicacionRepository $tipoComunicacionRepository, TipoComunicacion $tipoComunicacion): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_ADMIN');
        if ($request->request->has('confirmar')) {
            try {
                $tipoComunicacionRepository->eliminar($tipoComunicacion);
                $tipoComunicacionRepository->guardar();
                $this->addFlash('exito', 'Tipo de comunicacion eliminado con éxito');
                return $this->redirectToRoute('tipoComunicacion_listar');
            } catch (\Exception $e) {
                $this->addFlash('error', '¡Ocurrió un error al eliminar el tipo de comunicación!');
            }
        }
        return $this->render('tipoComunicacion/eliminar.html.twig', [
            'tipoComunicacion' => $tipoComunicacion
        ]);
    }
}
