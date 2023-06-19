<?php

namespace App\Controller;

use App\Entity\Medida;
use App\Form\MedidaType;
use App\Repository\MedidaRepository;
use Exception;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MedidaController extends AbstractController
{
    /**
     * @Route("/medida", name="medida_listar")
     */
    public function listar(MedidaRepository $medidaRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $this->denyAccessUnlessGranted('ROLE_DOCENTE');
        $pagination = $paginator->paginate(
            $medidaRepository->findAllOrdenados(), /* Query - NO EL RESULTADO DE LA QUERY */
            $request->query->getInt('page', 1), /* Número de la página */
            10 /* Límite por página */
        );
        return $this->render('medida/listar.html.twig', [
            'pagination' => $pagination,
        ]);
    }

    /**
     * @Route ("/medida/nuevo", name="medida_nuevo")
     */
    public function nuevoMedida(Request $request, MedidaRepository $medidaRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_DOCENTE');
        $medida = $medidaRepository->nuevo();

        return $this->modificarMedida($request, $medidaRepository, $medida);
    }

    /**
     * @Route("/medida/{id}", name="medida_modificar", requirements={"id":"\d+"})
     */
    public function modificarMedida(Request $request, MedidaRepository $medidaRepository, Medida $medida): Response
    {
        $this->denyAccessUnlessGranted('ROLE_DOCENTE');
        $form = $this->createForm(MedidaType::class, $medida);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $medidaRepository->guardar();
                $this->addFlash('exito', 'Cambios guardados con éxito');
                return $this->redirectToRoute('medida_listar');
            } catch (Exception $e) {
                $this->addFlash('error', 'No se han podido guardar los cambios');
            }
        }
        return $this->render('medida/modificar.html.twig', [
            'medida' => $medida,
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/medida/eliminar/{id}", name="medida_eliminar", requirements={"id":"\d+"})
     */
    public function eliminarMedida(Request $request, MedidaRepository $medidaRepository, Medida $medida): Response
    {
        $this->denyAccessUnlessGranted('ROLE_DOCENTE');
        if ($request->request->has('confirmar')) {
            try {
                $medidaRepository->eliminar($medida);
                $medidaRepository->guardar();
                $this->addFlash('exito', 'Medida eliminada con éxito');
                return $this->redirectToRoute('medida_listar');
            } catch (Exception $e) {
                $this->addFlash('error', '¡Ocurrió un error al eliminar la medida!');
            }
        }
        return $this->render('medida/eliminar.html.twig', [
            'medida' => $medida
        ]);
    }
}
