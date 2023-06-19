<?php

namespace App\Controller;

use App\Entity\Estudiante;
use App\Form\ComunicacionParteType;
use App\Form\ComunicacionSancionType;
use App\Form\EstudianteType;
use App\Form\SancionType;
use App\Repository\ComunicacionParteRepository;
use App\Repository\ComunicacionSancionRepository;
use App\Repository\EstudianteRepository;
use App\Repository\GrupoRepository;
use App\Repository\ParteRepository;
use App\Repository\SancionRepository;
use DateTime;
use Exception;
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
     * @Route("/estudiantes_sancionables", name="estudiantes_listar_sancionables")
     */
    public function listarSancionables(EstudianteRepository $estudianteRepository, PaginatorInterface $paginator, Request $request): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_USUARIO');
        $pagination = $paginator->paginate(
            $estudianteRepository->findAllEstudiantesDeGruposDelCursoActualSancionables(), /* Query - NO EL RESULTADO DE LA QUERY */
            $request->query->getInt('page', 1), /* Número de la página */
            10 /* Límite por página */
        );
        return $this->render('estudiante/estudiantes_sancionables.html.twig', [
            'pagination' => $pagination,
        ]);
    }

    /**
     * @Route("/estudiantes_notificables", name="estudiantes_listar_notificables")
     */
    public function listarNotificables(EstudianteRepository $estudianteRepository, PaginatorInterface $paginator, Request $request): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_USUARIO');
        $pagination = $paginator->paginate(
            $estudianteRepository->findAllEstudiantesDeGruposDelCursoActualNoNotificados(), /* Query - NO EL RESULTADO DE LA QUERY */
            $request->query->getInt('page', 1), /* Número de la página */
            10 /* Límite por página */
        );
        return $this->render('estudiante/estudiantes_por_notificar.html.twig', [
            'pagination' => $pagination,
            'docente' => $this->getUser()
        ]);
    }

    /**
     * @Route("/estudiantes_sanciones_notificables", name="estudiantes_listar_sanciones_notificables")
     */
    public function listarSancionesNotificables(EstudianteRepository $estudianteRepository, PaginatorInterface $paginator, Request $request, SancionRepository $sancionRepository): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_USUARIO');

        $estudianteRepository->findAllEstudiantesDeGruposDelCursoActualConSancionesNoNotificadas();
        $pagination = $paginator->paginate(
            $estudianteRepository->findAllEstudiantesDeGruposDelCursoActualConSancionesNoNotificadas(), /* Query - NO EL RESULTADO DE LA QUERY */
            $request->query->getInt('page', 1), /* Número de la página */
            10 /* Límite por página */
        );
        return $this->render('estudiante/estudiantes_sanciones_por_notificar.html.twig', [
            'pagination' => $pagination,
            'docente' => $this->getUser()
        ]);
    }

    /**
     * @Route("/estudiante_sancionar/{id}", name="estudiante_sancionar", requirements={"id":"\d+"})
     */
    public function sancionarEstudiante(Estudiante $estudiante, SancionRepository $sancionRepository, ParteRepository $parteRepository, Request $request): Response
    {
        $sancion = $sancionRepository->nuevo();
        $sancion->setFechaSancion(new DateTime());
        $sancion->setRegistradoEnSeneca(false);
        $partes = $parteRepository->findAllSancionablesPorEstudiante($estudiante);

        $form = $this->createForm(SancionType::class, $sancion, [
            'estudiante' => $estudiante,
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $partesSancion = $form->get('partes')->getData();
                foreach ($partesSancion as $parte) {
                    $parte->setSancion($sancion);
                    $parteRepository->guardar();
                }
                $sancionRepository->guardar();
                $numPartes = count($form->get('partes')->getData());
                $this->addFlash('exito', ($numPartes == 1) ? 'Se ha sancionado un parte con éxito' : 'Se han sancionado ' . $numPartes . ' con éxito');
                $partes = $parteRepository->findAllSancionablesPorEstudiante($estudiante);
                return $this->redirectToRoute('estudiante_sancionar', ['id' => $estudiante->getId()]);
            } catch (Exception $e) {
                $this->addFlash('error', 'No se han podido guardar los cambios');
                dump($e);
            }
        }
        return $this->render('estudiante/estudiante_sancionar.html.twig', [
            'estudiante' => $estudiante,
            'sancion' => $sancion,
            'partes' => $partes,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/estudiante_notificar/{id}", name="estudiante_notificar", requirements={"id":"\d+"})
     */
    public function notificarPartesEstudiante(Estudiante $estudiante, ComunicacionParteRepository $comunicacionParteRepository, ParteRepository $parteRepository, Request $request): Response
    {
        $comunicacionParte = $comunicacionParteRepository->nuevo();
        $partes = $parteRepository->findNoNotificadosPorDocente($this->getUser());

        $form = $this->createForm(ComunicacionParteType::class, $comunicacionParte, [
            'estudiante' => $estudiante,
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $partesComunicacion = $form->get('parte')->getData();
                foreach ($partesComunicacion as $parte) {
                    $parte->addComunicacionParte($comunicacionParte);
                    if ($parte->getFechaAviso() == null) {
                        $parte->setFechaAviso($comunicacionParte->getFecha());
                    }
                    $parteRepository->guardar();
                }
                $comunicacionParteRepository->guardar();
                $numPartes = count($form->get('parte')->getData());
                $this->addFlash('exito', ($numPartes == 1) ? 'Se ha comunicado un parte con éxito' : 'Se han comunicado ' . $numPartes . ' partes con éxito');
                $partes = $parteRepository->findNoNotificadosPorEstudiante($estudiante);
                return $this->redirectToRoute('estudiante_notificar', ['id' => $estudiante->getId()]);
            } catch (Exception $e) {
                $this->addFlash('error', 'No se han podido guardar los cambios');
                dump($e);
            }
        }
        return $this->render('estudiante/estudiante_notificar.html.twig', [
            'estudiante' => $estudiante,
            'docente' => $this->getUser(),
            'comunicacion' => $comunicacionParte,
            'partes' => $partes,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/estudiante_notificar_sanciones/{id}", name="estudiante_notificar_sanciones", requirements={"id":"\d+"})
     */
    public function notificarSancionesEstudiante(Estudiante $estudiante, ComunicacionSancionRepository $comunicacionSancionRepository, SancionRepository $sancionRepository, Request $request): Response
    {
        $comunicacionSancion = $comunicacionSancionRepository->nuevo();
        $sanciones = $sancionRepository->findAllNoNotificadasPorEstudiante($estudiante);

        $form = $this->createForm(ComunicacionSancionType::class, $comunicacionSancion, [
            'estudiante' => $estudiante,
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $sancionesComunicacion = $form->get('sancion')->getData();
                dump($sancionesComunicacion);
                foreach ($sancionesComunicacion as $sancion) {
                    $sancion->addComunicacion($comunicacionSancion);
                    if ($sancion->getFechaComunicado() == null) {
                        $sancion->setFechaComunicado($comunicacionSancion->getFecha());
                    }
                    $sancionRepository->guardar();
                }
                $comunicacionSancionRepository->guardar();
                $numSanciones = count($form->get('sancion')->getData());
                $this->addFlash('exito', ($numSanciones == 1) ? 'Se ha comunicado una sanción con éxito' : 'Se han comunicado ' . $numSanciones . ' sanciones con éxito');
                $sanciones = $sancionRepository->findAllNoNotificadasPorEstudiante($estudiante);
                return $this->redirectToRoute('estudiante_notificar_sanciones', ['id' => $estudiante->getId()]);
            } catch (Exception $e) {
                $this->addFlash('error', 'No se han podido guardar los cambios');
                dump($e);
            }
        }
        return $this->render('estudiante/estudiante_notificar_sanciones.html.twig', [
            'estudiante' => $estudiante,
            'docente' => $this->getUser(),
            'comunicacion' => $comunicacionSancion,
            'sanciones' => $sanciones,
            'form' => $form->createView()
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
    public function modificarEstudiante(Request $request, EstudianteRepository $estudianteRepository, Estudiante $estudiante, GrupoRepository $grupoRepository): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_EDITOR');
        $form = $this->createForm(EstudianteType::class, $estudiante);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $entityManager = $this->getDoctrine()->getManager();
                $grupos = $form->get('grupos')->getData();
                foreach ($grupos as $grupo) {
                    $estudiante->addGrupo($grupo);
                    $grupo->addEstudiante($estudiante);
                    $entityManager->persist($grupo);
                }
                $entityManager->persist($estudiante);
                $grupoRepository->guardar();
                $estudianteRepository->guardar();
                $this->addFlash('exito', 'Cambios guardados con éxito');
                return $this->redirectToRoute('estudiante_listar');
            } catch (Exception $e) {
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
            } catch (Exception $e) {
                $this->addFlash('error', '¡Ocurrió un error al eliminar el estudiante!');
            }
        }
        return $this->render('estudiante/eliminar.html.twig', [
            'estudiante' => $estudiante
        ]);
    }
}
