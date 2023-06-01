<?php

namespace App\Controller;

use App\Entity\CategoriaConductaContraria;
use App\Form\CategoriaConductaContrariaType;
use App\Repository\CategoriaConductaContrariaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoriaConductaContrariaController extends AbstractController
{
    /**
     * @Route("/categoriaConductaContraria", name="categoriaConductaContraria_listar")
     */
    public function listar(CategoriaConductaContrariaRepository $categoriaConductaContrariaRepository): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_USUARIO');
        $categoriasConductasContrarias = $categoriaConductaContrariaRepository->findAll();
        return $this->render('categoriaConductaContraria/listar.html.twig', [
            'categoriasConductasContrarias' => $categoriasConductasContrarias
        ]);
    }

    /**
     * @Route ("/categoriaConductaContraria/nuevo", name="categoriaConductaContraria_nuevo")
     */
    public function nuevoCategoriaConductaContraria(Request $request, CategoriaConductaContrariaRepository $categoriaConductaContrariaRepository): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_EDITOR');
        $categoriaConductaContraria = $categoriaConductaContrariaRepository->nuevo();

        return $this->modificarCategoriaConductaContraria($request, $categoriaConductaContrariaRepository, $categoriaConductaContraria);
    }

    /**
     * @Route("/categoriaConductaContraria/{id}", name="categoriaConductaContraria_modificar")
     */
    public function modificarCategoriaConductaContraria(Request $request, CategoriaConductaContrariaRepository $categoriaConductaContrariaRepository, CategoriaConductaContraria $categoriaConductaContraria): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_EDITOR');
        $form = $this->createForm(CategoriaConductaContrariaType::class, $categoriaConductaContraria);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $categoriaConductaContrariaRepository->guardar();
                $this->addFlash('exito', 'Cambios guardados con éxito');
                return $this->redirectToRoute('categoriaConductaContraria_listar');
            } catch (\Exception $e) {
                $this->addFlash('error', 'No se han podido guardar los cambios');
            }
        }
        return $this->render('categoriaConductaContraria/modificar.html.twig', [
            'categoriaConductaContraria' => $categoriaConductaContraria,
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/categoriaConductaContraria/eliminar/{id}", name="categoriaConductaContraria_eliminar")
     */
    public function eliminarCategoriaConductaContraria(Request $request, CategoriaConductaContrariaRepository $categoriaConductaContrariaRepository, CategoriaConductaContraria $categoriaConductaContraria): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_ADMIN');
        if ($request->request->has('confirmar')) {
            try {
                $categoriaConductaContrariaRepository->eliminar($categoriaConductaContraria);
                $categoriaConductaContrariaRepository->guardar();
                $this->addFlash('exito', 'Categoria de conducta contraria eliminada con éxito');
                return $this->redirectToRoute('categoriaConductaContraria_listar');
            } catch (\Exception $e) {
                $this->addFlash('error', '¡Ocurrió un error al eliminar la categoria de conducta contraria!');
            }
        }
        return $this->render('categoriaConductaContraria/eliminar.html.twig', [
            'categoriaConductaContraria' => $categoriaConductaContraria
        ]);
    }
}
