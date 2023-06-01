<?php

namespace App\Controller;

use App\Entity\ComunicacionParte;
use App\Form\ComunicacionParteType;
use App\Repository\ComunicacionParteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ComunicacionParteController extends AbstractController
{
    /**
     * @Route("/comunicacionParte", name="comunicacionParte_listar")
     */
    public function listar(ComunicacionParteRepository $comunicacionParteRepository): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_USUARIO');
        $comunicacionesPartes = $comunicacionParteRepository->findAll();
        return $this->render('comunicacionParte/listar.html.twig', [
            'comunicacionesPartes' => $comunicacionesPartes
        ]);
    }

    /**
     * @Route ("/comunicacionParte/nuevo", name="comunicacionParte_nuevo")
     */
    public function nuevoComunicacionParte(Request $request, ComunicacionParteRepository $comunicacionParteRepository): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_EDITOR');
        $comunicacionParte = $comunicacionParteRepository->nuevo();

        return $this->modificarComunicacionParte($request, $comunicacionParteRepository, $comunicacionParte);
    }

    /**
     * @Route("/comunicacionParte/{id}", name="comunicacionParte_modificar")
     */
    public function modificarComunicacionParte(Request $request, ComunicacionParteRepository $comunicacionParteRepository, ComunicacionParte $comunicacionParte): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_EDITOR');
        $form = $this->createForm(ComunicacionParteType::class, $comunicacionParte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $comunicacionParteRepository->guardar();
                $this->addFlash('exito', 'Cambios guardados con éxito');
                return $this->redirectToRoute('comunicacionParte_listar');
            } catch (\Exception $e) {
                $this->addFlash('error', 'No se han podido guardar los cambios');
            }
        }
        return $this->render('comunicacionParte/modificar.html.twig', [
            'comunicacionParte' => $comunicacionParte,
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/comunicacionParte/eliminar/{id}", name="comunicacionParte_eliminar")
     */
    public function eliminarComunicacionParte(Request $request, ComunicacionParteRepository $comunicacionParteRepository, ComunicacionParte $comunicacionParte): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_ADMIN');
        if ($request->request->has('confirmar')) {
            try {
                $comunicacionParteRepository->eliminar($comunicacionParte);
                $comunicacionParteRepository->guardar();
                $this->addFlash('exito', 'Comunicacion de parte eliminada con éxito');
                return $this->redirectToRoute('comunicacionParte_listar');
            } catch (\Exception $e) {
                $this->addFlash('error', '¡Ocurrió un error al eliminar la comunicación de parte!');
            }
        }
        return $this->render('comunicacionParte/eliminar.html.twig', [
            'comunicacionParte' => $comunicacionParte
        ]);
    }
}
