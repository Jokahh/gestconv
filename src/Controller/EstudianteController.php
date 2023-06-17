<?php

namespace App\Controller;

use App\Entity\Estudiante;
use App\Form\EstudianteType;
use App\Repository\CursoAcademicoRepository;
use App\Repository\EstudianteRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EstudianteController extends AbstractController
{
    /**
     * @Route("/estudiante", name="estudiante_listar")
     */
    public function listar(EstudianteRepository $estudianteRepository, PaginatorInterface $paginator, Request $request): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_USUARIO');
        $pagination = $paginator->paginate(
            $estudianteRepository->findAll(), /* Query - NO EL RESULTADO DE LA QUERY */
            $request->query->getInt('page', 1), /* Número de la página */
            10 /* Límite por página */
        );
        return $this->render('estudiante/listar.html.twig', [
            'pagination' => $pagination,
            'cursoActual' => false
        ]);
    }

    /**
     * @Route("/estudiante_grupo_curso_actual", name="estudiante_listar_grupo_curso_actual")
     */
    public function listarEstudiantesDeGruposDelCursoActual(EstudianteRepository $estudianteRepository, PaginatorInterface $paginator, Request $request): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_USUARIO');
        $pagination = $paginator->paginate(
            $estudianteRepository->findAllEstudiantesDeGruposDelCursoActual(), /* Query - NO EL RESULTADO DE LA QUERY */
            $request->query->getInt('page', 1), /* Número de la página */
            10 /* Límite por página */
        );
        return $this->render('estudiante/listar.html.twig', [
            'pagination' => $pagination,
            'cursoActual' => true
        ]);
    }

    /**
     * @Route ("/estudiante/nuevo", name="estudiante_nuevo")
     */
    public function nuevoEstudiante(Request $request, EstudianteRepository $estudianteRepository): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_EDITOR');
        $estudiante = $estudianteRepository->nuevo();

        return $this->modificarEstudiante($request, $estudianteRepository, $estudiante);
    }

    /**
     * @Route("/estudiante/{id}", name="estudiante_modificar", requirements={"id":"\d+"})
     */
    public function modificarEstudiante(Request $request, EstudianteRepository $estudianteRepository, Estudiante $estudiante): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_EDITOR');
        $form = $this->createForm(EstudianteType::class, $estudiante);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $estudianteRepository->guardar();
                $this->addFlash('exito', 'Cambios guardados con éxito');
                return $this->redirectToRoute('estudiante_listar');
            } catch (\Exception $e) {
                $this->addFlash('error', 'No se han podido guardar los cambios');
            }
        }
        return $this->render('estudiante/modificar.html.twig', [
            'estudiante' => $estudiante,
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/estudiante/eliminar/{id}", name="estudiante_eliminar", requirements={"id":"\d+"})
     */
    public function eliminarEstudiante(Request $request, EstudianteRepository $estudianteRepository, Estudiante $estudiante): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_ADMIN');
        if ($request->request->has('confirmar')) {
            try {
                $estudianteRepository->eliminar($estudiante);
                $estudianteRepository->guardar();
                $this->addFlash('exito', 'Estudiante eliminado con éxito');
                return $this->redirectToRoute('estudiante_listar');
            } catch (\Exception $e) {
                $this->addFlash('error', '¡Ocurrió un error al eliminar el estudiante!');
            }
        }
        return $this->render('estudiante/eliminar.html.twig', [
            'estudiante' => $estudiante
        ]);
    }
}
