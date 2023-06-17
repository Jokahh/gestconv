<?php

namespace App\Controller;

use App\Entity\CategoriaMedida;
use App\Form\CategoriaMedidaType;
use App\Repository\CategoriaMedidaRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoriaMedidaController extends AbstractController
{
    /**
     * @Route("/categoria_medida", name="categoria_medida_listar")
     */
    public function listar(CategoriaMedidaRepository $categoriaMedidaRepository, PaginatorInterface $paginator, Request $request): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_USUARIO');
        $pagination = $paginator->paginate(
            $categoriaMedidaRepository->findAllOrdenados(), /* Query - NO EL RESULTADO DE LA QUERY */
            $request->query->getInt('page', 1), /* Número de la página */
            10 /* Límite por página */
        );
        return $this->render('categoria_medida/listar.html.twig', [
            'pagination' => $pagination,
        ]);
    }

    /**
     * @Route ("/categoria_medida/nuevo", name="categoria_medida_nuevo")
     */
    public function nuevoCategoriaMedida(Request $request, CategoriaMedidaRepository $categoriaMedidaRepository): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_EDITOR');
        $categoriaMedida = $categoriaMedidaRepository->nuevo();

        return $this->modificarCategoriaMedida($request, $categoriaMedidaRepository, $categoriaMedida);
    }

    /**
     * @Route("/categoria_medida/{id}", name="categoria_medida_modificar", requirements={"id":"\d+"})
     */
    public function modificarCategoriaMedida(Request $request, CategoriaMedidaRepository $categoriaMedidaRepository, CategoriaMedida $categoriaMedida): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_EDITOR');
        $form = $this->createForm(CategoriaMedidaType::class, $categoriaMedida);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $categoriaMedidaRepository->guardar();
                $this->addFlash('exito', 'Cambios guardados con éxito');
                return $this->redirectToRoute('categoria_medida_listar');
            } catch (\Exception $e) {
                $this->addFlash('error', 'No se han podido guardar los cambios');
            }
        }
        return $this->render('categoria_medida/modificar.html.twig', [
            'categoriaMedida' => $categoriaMedida,
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/categoria_medida/eliminar/{id}", name="categoria_medida_eliminar", requirements={"id":"\d+"})
     */
    public function eliminarCategoriaMedida(Request $request, CategoriaMedidaRepository $categoriaMedidaRepository, CategoriaMedida $categoriaMedida): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_ADMIN');
        if ($request->request->has('confirmar')) {
            try {
                $categoriaMedidaRepository->eliminar($categoriaMedida);
                $categoriaMedidaRepository->guardar();
                $this->addFlash('exito', 'Categoria de medida eliminada con éxito');
                return $this->redirectToRoute('categoria_medida_listar');
            } catch (\Exception $e) {
                $this->addFlash('error', '¡Ocurrió un error al eliminar la categoria de medida!');
            }
        }
        return $this->render('categoria_medida/eliminar.html.twig', [
            'categoriaMedida' => $categoriaMedida
        ]);
    }
}
