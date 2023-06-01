<?php

namespace App\Controller;

use App\Entity\CategoriaMedida;
use App\Form\CategoriaMedidaType;
use App\Repository\CategoriaMedidaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoriaMedidaController extends AbstractController
{
    /**
     * @Route("/categoriaMedida", name="categoriaMedida_listar")
     */
    public function listar(CategoriaMedidaRepository $categoriaMedidaRepository): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_USUARIO');
        $categoriasMedidas = $categoriaMedidaRepository->findAll();
        return $this->render('categoriaMedida/listar.html.twig', [
            'categoriasMedidas' => $categoriasMedidas
        ]);
    }

    /**
     * @Route ("/categoriaMedida/nuevo", name="categoriaMedida_nuevo")
     */
    public function nuevoCategoriaMedida(Request $request, CategoriaMedidaRepository $categoriaMedidaRepository): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_EDITOR');
        $categoriaMedida = $categoriaMedidaRepository->nuevo();
        
        return $this->modificarCategoriaMedida($request, $categoriaMedidaRepository, $categoriaMedida);
    }

    /**
     * @Route("/categoriaMedida/{id}", name="categoriaMedida_modificar")
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
                return $this->redirectToRoute('categoriaMedida_listar');
            } catch (\Exception $e) {
                $this->addFlash('error', 'No se han podido guardar los cambios');
            }
        }
        return $this->render('categoriaMedida/modificar.html.twig', [
            'categoriaMedida' => $categoriaMedida,
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/categoriaMedida/eliminar/{id}", name="categoriaMedida_eliminar")
     */
    public function eliminarCategoriaMedida(Request $request, CategoriaMedidaRepository $categoriaMedidaRepository, CategoriaMedida $categoriaMedida): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_ADMIN');
        if ($request->request->has('confirmar')) {
            try {
                $categoriaMedidaRepository->eliminar($categoriaMedida);
                $categoriaMedidaRepository->guardar();
                $this->addFlash('exito', 'Categoria de medida eliminada con éxito');
                return $this->redirectToRoute('categoriaMedida_listar');
            } catch (\Exception $e) {
                $this->addFlash('error', '¡Ocurrió un error al eliminar la categoria de medida!');
            }
        }
        return $this->render('categoriaMedida/eliminar.html.twig', [
            'categoriaMedida' => $categoriaMedida
        ]);
    }
}
