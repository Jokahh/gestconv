<?php

namespace App\Controller;

use App\Entity\Docente;
use App\Form\DocenteType;
use App\Repository\DocenteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DocenteController extends AbstractController
{
    /**
     * @Route("/docente", name="docente_listar")
     */
    public function listar(DocenteRepository $docenteRepository): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_USUARIO');
        $docentes = $docenteRepository->findAll();
        return $this->render('docente/listar.html.twig', [
            'docentes' => $docentes
        ]);
    }

    /**
     * @Route ("/docente/nuevo", name="docente_nuevo")
     */
    public function nuevoDocente(Request $request, DocenteRepository $docenteRepository): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_EDITOR');
        $docente = $docenteRepository->nuevo();
        
        return $this->modificarDocente($request, $docenteRepository, $docente);
    }

    /**
     * @Route("/docente/{id}", name="docente_modificar")
     */
    public function modificarDocente(Request $request, DocenteRepository $docenteRepository, Docente $docente): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_EDITOR');
        $form = $this->createForm(DocenteType::class, $docente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $docenteRepository->guardar();
                $this->addFlash('exito', 'Cambios guardados con éxito');
                return $this->redirectToRoute('docente_listar');
            } catch (\Exception $e) {
                $this->addFlash('error', 'No se han podido guardar los cambios');
            }
        }
        return $this->render('docente/modificar.html.twig', [
            'docente' => $docente,
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/docente/eliminar/{id}", name="docente_eliminar")
     */
    public function eliminarDocente(Request $request, DocenteRepository $docenteRepository, Docente $docente): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_ADMIN');
        if ($request->request->has('confirmar')) {
            try {
                $docenteRepository->eliminar($docente);
                $docenteRepository->guardar();
                $this->addFlash('exito', 'Docente eliminado con éxito');
                return $this->redirectToRoute('docente_listar');
            } catch (\Exception $e) {
                $this->addFlash('error', '¡Ocurrió un error al eliminar el docente!');
            }
        }
        return $this->render('docente/eliminar.html.twig', [
            'docente' => $docente
        ]);
    }
}
