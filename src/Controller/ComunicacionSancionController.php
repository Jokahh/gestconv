<?php

namespace App\Controller;

use App\Entity\ComunicacionSancion;
use App\Form\ComunicacionSancionType;
use App\Repository\ComunicacionSancionRepository;
use App\Repository\SancionRepository;
use Exception;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ComunicacionSancionController extends AbstractController
{
    /**
     * @Route("/comunicacion_sancion", name="comunicacion_sancion_listar")
     */
    public function listar(ComunicacionSancionRepository $comunicacionSancionRepository, PaginatorInterface $paginator, Request $request): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_USUARIO');
        $pagination = $paginator->paginate(
            $comunicacionSancionRepository->findAll(), /* Query - NO EL RESULTADO DE LA QUERY */
            $request->query->getInt('page', 1), /* Número de la página */
            10 /* Límite por página */
        );
        return $this->render('comunicacion_sancion/listar.html.twig', [
            'pagination' => $pagination,
        ]);
    }

    /**
     * @Route ("/comunicacion_sancion/nuevo", name="comunicacion_sancion_nuevo")
     */
    public function nuevoComunicacionSancion(Request $request, ComunicacionSancionRepository $comunicacionSancionRepository, SancionRepository $sancionRepository): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_EDITOR');
        $comunicacionSancion = $comunicacionSancionRepository->nuevo();

        return $this->modificarComunicacionSancion($request, $comunicacionSancionRepository, $comunicacionSancion, $sancionRepository);
    }

    /**
     * @Route("/comunicacion_sancion/{id}", name="comunicacion_sancion_modificar", requirements={"id":"\d+"})
     */
    public function modificarComunicacionSancion(Request $request, ComunicacionSancionRepository $comunicacionSancionRepository, ComunicacionSancion $comunicacionSancion, SancionRepository $sancionRepository): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_EDITOR');
        $form = $this->createForm(ComunicacionSancionType::class, $comunicacionSancion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $sancion = $comunicacionSancion->getSancion();
                if ($sancion->getFechaComunicado() == null) {
                    $sancion->setFechaComunicado($comunicacionSancion->getFecha());
                    $sancionRepository->guardar();
                }
                $comunicacionSancionRepository->guardar();
                $this->addFlash('exito', 'Cambios guardados con éxito');
                return $this->redirectToRoute('comunicacion_sancion_listar');
            } catch (Exception $e) {
                $this->addFlash('error', 'No se han podido guardar los cambios');
            }
        }
        return $this->render('comunicacion_sancion/modificar.html.twig', [
            'comunicacionSancion' => $comunicacionSancion,
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/comunicacion_sancion/eliminar/{id}", name="comunicacion_sancion_eliminar", requirements={"id":"\d+"})
     */
    public function eliminarComunicacionSancion(Request $request, ComunicacionSancionRepository $comunicacionSancionRepository, ComunicacionSancion $comunicacionSancion): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_ADMIN');
        if ($request->request->has('confirmar')) {
            try {
                $comunicacionSancionRepository->eliminar($comunicacionSancion);
                $comunicacionSancionRepository->guardar();
                $this->addFlash('exito', 'Comunicacion de sanción eliminada con éxito');
                return $this->redirectToRoute('comunicacion_sancion_listar');
            } catch (Exception $e) {
                $this->addFlash('error', '¡Ocurrió un error al eliminar la comunicación de sanción!');
            }
        }
        return $this->render('comunicacion_sancion/eliminar.html.twig', [
            'comunicacionSancion' => $comunicacionSancion
        ]);
    }
}
