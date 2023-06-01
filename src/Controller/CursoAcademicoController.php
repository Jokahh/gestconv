<?php

namespace App\Controller;

use App\Entity\CursoAcademico;
use App\Form\CursoAcademicoType;
use App\Repository\CursoAcademicoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CursoAcademicoController extends AbstractController
{
    /**
     * @Route("/curso_academico", name="curso_academico_listar")
     */
    public function listar(CursoAcademicoRepository $cursoAcademicoRepository): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_USUARIO');
        $cursosAcademicos = $cursoAcademicoRepository->findAll();
        return $this->render('curso_academico/listar.html.twig', [
            'cursos_academicos' => $cursosAcademicos
        ]);
    }

    /**
     * @Route ("/curso_academico/nuevo", name="curso_academico_nuevo")
     */
    public function nuevoCursoAcademico(Request $request, CursoAcademicoRepository $cursoAcademicoRepository): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_EDITOR');
        $cursoAcademico = $cursoAcademicoRepository->nuevo();
        
        return $this->modificarCursoAcademico($request, $cursoAcademicoRepository, $cursoAcademico);
    }

    /**
     * @Route("/curso_academico/{id}", name="curso_academico_modificar")
     */
    public function modificarCursoAcademico(Request $request, CursoAcademicoRepository $cursoAcademicoRepository, CursoAcademico $cursoAcademico): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_EDITOR');
        $form = $this->createForm(CursoAcademicoType::class, $cursoAcademico);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $cursoAcademicoRepository->guardar();
                $this->addFlash('exito', 'Cambios guardados con éxito');
                return $this->redirectToRoute('curso_academico_listar');
            } catch (\Exception $e) {
                $this->addFlash('error', 'No se han podido guardar los cambios');
            }
        }
        return $this->render('curso_academico/modificar.html.twig', [
            'curso_academico' => $cursoAcademico,
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/curso_academico/eliminar/{id}", name="curso_academico_eliminar")
     */
    public function eliminarCursoAcademico(Request $request, CursoAcademicoRepository $cursoAcademicoRepository, CursoAcademico $cursoAcademico): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_ADMIN');
        if ($request->request->has('confirmar')) {
            try {
                $cursoAcademicoRepository->eliminar($cursoAcademico);
                $cursoAcademicoRepository->guardar();
                $this->addFlash('exito', 'Curso académico eliminado con éxito');
                return $this->redirectToRoute('curso_academico_listar');
            } catch (\Exception $e) {
                $this->addFlash('error', '¡Ocurrió un error al eliminar el curso académico!');
            }
        }
        return $this->render('curso_academico/eliminar.html.twig', [
            'curso_academico' => $cursoAcademico
        ]);
    }
}
