<?php

namespace App\Controller;

use App\Entity\ActitudFamilia;
use App\Form\ActitudFamiliaType;
use App\Repository\ActitudFamiliaRepository;
use Exception;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ActitudFamiliaController extends AbstractController
{
    /**
     * @Route("/actitud_familia", name="actitud_familia_listar")
     */
    public function listar(ActitudFamiliaRepository $actitudFamiliaRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $this->denyAccessUnlessGranted('ROLE_DIRECTIVO');
        $pagination = $paginator->paginate(
            $actitudFamiliaRepository->findAllOrdenados(), /* Query - NO EL RESULTADO DE LA QUERY */
            $request->query->getInt('page', 1), /* Número de la página */
            10 /* Límite por página */
        );
        return $this->render('actitud_familia/listar.html.twig', [
            'pagination' => $pagination,
            'cursoActual' => false
        ]);
    }

    /**
     * @Route("/actitud_familia_actual", name="actitud_familia_listar_curso_actual")
     */
    public function listarActitudesCursoActual(ActitudFamiliaRepository $actitudFamiliaRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $this->denyAccessUnlessGranted('ROLE_DIRECTIVO');
        $pagination = $paginator->paginate(
            $actitudFamiliaRepository->findAllByCursoActivo(), /* Query - NO EL RESULTADO DE LA QUERY */
            $request->query->getInt('page', 1), /* Número de la página */
            10 /* Límite por página */
        );
        return $this->render('actitud_familia/listar.html.twig', [
            'pagination' => $pagination,
            'cursoActual' => true
        ]);
    }

    /**
     * @Route ("/actitud_familia/nuevo", name="actitud_familia_nuevo")
     */
    public function nuevoActitudFamilia(Request $request, ActitudFamiliaRepository $actitudFamiliaRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_DIRECTIVO');
        $actitudFamilia = $actitudFamiliaRepository->nuevo();

        return $this->modificarActitudFamilia($request, $actitudFamiliaRepository, $actitudFamilia);
    }

    /**
     * @Route("/actitud_familia/{id}", name="actitud_familia_modificar", requirements={"id":"\d+"})
     */
    public function modificarActitudFamilia(Request $request, ActitudFamiliaRepository $actitudFamiliaRepository, ActitudFamilia $actitudFamilia): Response
    {
        $this->denyAccessUnlessGranted('ROLE_DIRECTIVO');
        $form = $this->createForm(ActitudFamiliaType::class, $actitudFamilia);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $actitudFamiliaRepository->guardar();
                $this->addFlash('exito', 'Cambios guardados con éxito');
                return $this->redirectToRoute('actitud_familia_listar');
            } catch (Exception $e) {
                $this->addFlash('error', 'No se han podido guardar los cambios');
            }
        }
        return $this->render('actitud_familia/modificar.html.twig', [
            'actitud_familia' => $actitudFamilia,
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/actitud_familia/eliminar/{id}", name="actitud_familia_eliminar", requirements={"id":"\d+"})
     */
    public function eliminarActitudFamilia(Request $request, ActitudFamiliaRepository $actitudFamiliaRepository, ActitudFamilia $actitudFamilia): Response
    {
        $this->denyAccessUnlessGranted('ROLE_DIRECTIVO');
        if ($request->request->has('confirmar')) {
            try {
                $actitudFamiliaRepository->eliminar($actitudFamilia);
                $actitudFamiliaRepository->guardar();
                $this->addFlash('exito', 'Actitud de familia eliminada con éxito');
                return $this->redirectToRoute('actitud_familia_listar');
            } catch (Exception $e) {
                $this->addFlash('error', '¡Ocurrió un error al eliminar la actitud de familia!');
            }
        }
        return $this->render('actitud_familia/eliminar.html.twig', [
            'actitud_familia' => $actitudFamilia
        ]);
    }
}
