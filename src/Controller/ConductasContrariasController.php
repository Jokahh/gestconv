<?php

namespace App\Controller;

use App\Entity\ConductasContrarias;
use App\Form\ConductasContrariasType;
use App\Repository\ConductasContrariasRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConductasContrariasController extends AbstractController
{
    /**
     * @Route("/conductaContraria", name="conductaContraria_listar")
     */
    public function listar(ConductasContrariasRepository $conductaContrariaRepository): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_USUARIO');
        $conductasContrarias = $conductaContrariaRepository->findAll();
        return $this->render('conductaContraria/listar.html.twig', [
            'conductasContrarias' => $conductasContrarias
        ]);
    }

    /**
     * @Route ("/conductaContraria/nuevo", name="conductaContraria_nuevo")
     */
    public function nuevoConductasContrarias(Request $request, ConductasContrariasRepository $conductaContrariaRepository): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_EDITOR');
        $conductaContraria = $conductaContrariaRepository->nuevo();
        
        return $this->modificarConductasContrarias($request, $conductaContrariaRepository, $conductaContraria);
    }

    /**
     * @Route("/conductaContraria/{id}", name="conductaContraria_modificar")
     */
    public function modificarConductasContrarias(Request $request, ConductasContrariasRepository $conductaContrariaRepository, ConductasContrarias $conductaContraria): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_EDITOR');
        $form = $this->createForm(ConductasContrariasType::class, $conductaContraria);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $conductaContrariaRepository->guardar();
                $this->addFlash('exito', 'Cambios guardados con éxito');
                return $this->redirectToRoute('conductaContraria_listar');
            } catch (\Exception $e) {
                $this->addFlash('error', 'No se han podido guardar los cambios');
            }
        }
        return $this->render('conductaContraria/modificar.html.twig', [
            'conductaContraria' => $conductaContraria,
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/conductaContraria/eliminar/{id}", name="conductaContraria_eliminar")
     */
    public function eliminarConductasContrarias(Request $request, ConductasContrariasRepository $conductaContrariaRepository, ConductasContrarias $conductaContraria): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_ADMIN');
        if ($request->request->has('confirmar')) {
            try {
                $conductaContrariaRepository->eliminar($conductaContraria);
                $conductaContrariaRepository->guardar();
                $this->addFlash('exito', 'Conducta contraria eliminada con éxito');
                return $this->redirectToRoute('conductaContraria_listar');
            } catch (\Exception $e) {
                $this->addFlash('error', '¡Ocurrió un error al eliminar la conducta contraria!');
            }
        }
        return $this->render('conductaContraria/eliminar.html.twig', [
            'conductaContraria' => $conductaContraria
        ]);
    }
}
