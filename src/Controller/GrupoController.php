<?php

namespace App\Controller;

use App\Entity\Grupo;
use App\Form\GrupoType;
use App\Repository\GrupoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GrupoController extends AbstractController
{
    /**
     * @Route("/grupo", name="grupo_listar")
     */
    public function listar(GrupoRepository $grupoRepository): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_USUARIO');
        $grupos = $grupoRepository->findAll();
        return $this->render('grupo/listar.html.twig', [
            'grupos' => $grupos
        ]);
    }

    /**
     * @Route ("/grupo/nuevo", name="grupo_nuevo")
     */
    public function nuevoGrupo(Request $request, GrupoRepository $grupoRepository): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_EDITOR');
        $grupo = $grupoRepository->nuevo();
        
        return $this->modificarGrupo($request, $grupoRepository, $grupo);
    }

    /**
     * @Route("/grupo/{id}", name="grupo_modificar")
     */
    public function modificarGrupo(Request $request, GrupoRepository $grupoRepository, Grupo $grupo): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_EDITOR');
        $form = $this->createForm(GrupoType::class, $grupo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $grupoRepository->guardar();
                $this->addFlash('exito', 'Cambios guardados con éxito');
                return $this->redirectToRoute('grupo_listar');
            } catch (\Exception $e) {
                $this->addFlash('error', 'No se han podido guardar los cambios');
            }
        }
        return $this->render('grupo/modificar.html.twig', [
            'grupo' => $grupo,
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/grupo/eliminar/{id}", name="grupo_eliminar")
     */
    public function eliminarGrupo(Request $request, GrupoRepository $grupoRepository, Grupo $grupo): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_ADMIN');
        if ($request->request->has('confirmar')) {
            try {
                $grupoRepository->eliminar($grupo);
                $grupoRepository->guardar();
                $this->addFlash('exito', 'Grupo eliminado con éxito');
                return $this->redirectToRoute('grupo_listar');
            } catch (\Exception $e) {
                $this->addFlash('error', '¡Ocurrió un error al eliminar el grupo!');
            }
        }
        return $this->render('grupo/eliminar.html.twig', [
            'grupo' => $grupo
        ]);
    }
}
