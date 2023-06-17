<?php

namespace App\Controller;

use App\Entity\ConductaContraria;
use App\Form\ConductaContrariaType;
use App\Repository\ConductaContrariaRepository;
use Exception;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConductaContrariaController extends AbstractController
{
    /**
     * @Route("/conducta_contraria", name="conducta_contraria_listar")
     */
    public function listar(ConductaContrariaRepository $conductaContrariaRepository, PaginatorInterface $paginator, Request $request): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_USUARIO');
        $pagination = $paginator->paginate(
            $conductaContrariaRepository->findAllOrdenados(), /* Query - NO EL RESULTADO DE LA QUERY */
            $request->query->getInt('page', 1), /* Número de la página */
            10 /* Límite por página */
        );
        return $this->render('conducta_contraria/listar.html.twig', [
            'pagination' => $pagination,
        ]);
    }

    /**
     * @Route ("/conducta_contraria/nuevo", name="conducta_contraria_nuevo")
     */
    public function nuevoConductaContraria(Request $request, ConductaContrariaRepository $conductaContrariaRepository): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_EDITOR');
        $conductaContraria = $conductaContrariaRepository->nuevo();

        return $this->modificarConductaContraria($request, $conductaContrariaRepository, $conductaContraria);
    }

    /**
     * @Route("/conducta_contraria/{id}", name="conducta_contraria_modificar", requirements={"id":"\d+"})
     */
    public function modificarConductaContraria(Request $request, ConductaContrariaRepository $conductaContrariaRepository, ConductaContraria $conductaContraria): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_EDITOR');
        $form = $this->createForm(ConductaContrariaType::class, $conductaContraria);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $conductaContrariaRepository->guardar();
                $this->addFlash('exito', 'Cambios guardados con éxito');
                return $this->redirectToRoute('conducta_contraria_listar');
            } catch (Exception $e) {
                $this->addFlash('error', 'No se han podido guardar los cambios');
            }
        }
        return $this->render('conducta_contraria/modificar.html.twig', [
            'conductaContraria' => $conductaContraria,
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/conducta_contraria/eliminar/{id}", name="conducta_contraria_eliminar", requirements={"id":"\d+"})
     */
    public function eliminarConductaContraria(Request $request, ConductaContrariaRepository $conductaContrariaRepository, ConductaContraria $conductaContraria): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_ADMIN');
        if ($request->request->has('confirmar')) {
            try {
                $conductaContrariaRepository->eliminar($conductaContraria);
                $conductaContrariaRepository->guardar();
                $this->addFlash('exito', 'Conducta contraria eliminada con éxito');
                return $this->redirectToRoute('conducta_contraria_listar');
            } catch (Exception $e) {
                $this->addFlash('error', '¡Ocurrió un error al eliminar la conducta contraria!');
            }
        }
        return $this->render('conducta_contraria/eliminar.html.twig', [
            'conductaContraria' => $conductaContraria
        ]);
    }
}
