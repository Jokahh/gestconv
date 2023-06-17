<?php

namespace App\Controller;

use App\Entity\CategoriaConductaContraria;
use App\Form\CategoriaConductaContrariaType;
use App\Repository\CategoriaConductaContrariaRepository;
use Exception;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoriaConductaContrariaController extends AbstractController
{
    /**
     * @Route("/categoria_conducta_contraria", name="categoria_conducta_contraria_listar")
     */
    public function listar(CategoriaConductaContrariaRepository $categoriaConductaContrariaRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $this->denyAccessUnlessGranted('ROLE_DIRECTIVO');
        $pagination = $paginator->paginate(
            $categoriaConductaContrariaRepository->findAllOrdenados(), /* Query - NO EL RESULTADO DE LA QUERY */
            $request->query->getInt('page', 1), /* Número de la página */
            10 /* Límite por página */
        );
        return $this->render('categoria_conducta_contraria/listar.html.twig', [
            'pagination' => $pagination,
            'cursoActual' => false
        ]);
    }

    /**
     * @Route("/categoria_conducta_contraria_actual", name="categoria_conducta_contraria_listar_curso_actual")
     */
    public function listarCategoriasCursoActual(CategoriaConductaContrariaRepository $categoriaConductaContrariaRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $this->denyAccessUnlessGranted('ROLE_DIRECTIVO');
        $pagination = $paginator->paginate(
            $categoriaConductaContrariaRepository->findAllByCursoActivo(), /* Query - NO EL RESULTADO DE LA QUERY */
            $request->query->getInt('page', 1), /* Número de la página */
            10 /* Límite por página */
        );
        return $this->render('categoria_conducta_contraria/listar.html.twig', [
            'pagination' => $pagination,
            'cursoActual' => true
        ]);
    }

    /**
     * @Route ("/categoria_conducta_contraria/nuevo", name="categoria_conducta_contraria_nuevo")
     */
    public function nuevoCategoriaConductaContraria(Request $request, CategoriaConductaContrariaRepository $categoriaConductaContrariaRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_DIRECTIVO');
        $categoriaConductaContraria = $categoriaConductaContrariaRepository->nuevo();

        return $this->modificarCategoriaConductaContraria($request, $categoriaConductaContrariaRepository, $categoriaConductaContraria);
    }

    /**
     * @Route("/categoria_conducta_contraria/{id}", name="categoria_conducta_contraria_modificar", requirements={"id":"\d+"})
     */
    public function modificarCategoriaConductaContraria(Request $request, CategoriaConductaContrariaRepository $categoriaConductaContrariaRepository, CategoriaConductaContraria $categoriaConductaContraria): Response
    {
        $this->denyAccessUnlessGranted('ROLE_DIRECTIVO');
        $form = $this->createForm(CategoriaConductaContrariaType::class, $categoriaConductaContraria);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $categoriaConductaContrariaRepository->guardar();
                $this->addFlash('exito', 'Cambios guardados con éxito');
                return $this->redirectToRoute('categoria_conducta_contraria_listar');
            } catch (Exception $e) {
                $this->addFlash('error', 'No se han podido guardar los cambios');
            }
        }
        return $this->render('categoria_conducta_contraria/modificar.html.twig', [
            'categoriaConductaContraria' => $categoriaConductaContraria,
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/categoria_conducta_contraria/eliminar/{id}", name="categoria_conducta_contraria_eliminar", requirements={"id":"\d+"})
     */
    public function eliminarCategoriaConductaContraria(Request $request, CategoriaConductaContrariaRepository $categoriaConductaContrariaRepository, CategoriaConductaContraria $categoriaConductaContraria): Response
    {
        $this->denyAccessUnlessGranted('ROLE_DIRECTIVO');
        if ($request->request->has('confirmar')) {
            try {
                $categoriaConductaContrariaRepository->eliminar($categoriaConductaContraria);
                $categoriaConductaContrariaRepository->guardar();
                $this->addFlash('exito', 'Categoria de conducta contraria eliminada con éxito');
                return $this->redirectToRoute('categoria_conducta_contraria_listar');
            } catch (Exception $e) {
                $this->addFlash('error', '¡Ocurrió un error al eliminar la categoria de conducta contraria!');
            }
        }
        return $this->render('categoria_conducta_contraria/eliminar.html.twig', [
            'categoriaConductaContraria' => $categoriaConductaContraria
        ]);
    }
}
