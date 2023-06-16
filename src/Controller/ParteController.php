<?php

namespace App\Controller;

use App\Entity\Parte;
use App\Form\ParteType;
use App\Repository\ParteRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ParteController extends AbstractController
{
    /**
     * @Route("/parte", name="parte_listar")
     */
    public function listar(ParteRepository $parteRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $this->denyAccessUnlessGranted('ROLE_PROFESOR');
        $pagination = $paginator->paginate(
            $parteRepository->findAll(), /* Query - NO EL RESULTADO DE LA QUERY */
            $request->query->getInt('page', 1), /* Número de la página */
            10 /* Límite por página */
        );
        return $this->render('parte/listar.html.twig', [
            'pagination' => $pagination
        ]);
    }

    /**
     * @Route ("/parte/nuevo", name="parte_nuevo")
     */
    public function nuevoParte(Request $request, ParteRepository $parteRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_PROFESOR');
        $parte = $parteRepository->nuevo();
        return $this->modificarParte($request, $parteRepository, $parte, true);
    }

    /**
     * @Route("/parte/{id}", name="parte_modificar", requirements={"id":"\d+"})
     */
    public function modificarParte(Request $request, ParteRepository $parteRepository, Parte $parte, $nuevo = false): Response
    {
        $this->denyAccessUnlessGranted('ROLE_PROFESOR');
        $parte->setFechaCreacion(new \DateTime());
        $form = $this->createForm(ParteType::class, $parte, [
            'nuevo' => $nuevo,
            'admin' => $this->isGranted('ROLE_DIRECTIVO')
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $parteRepository->guardar();
                $this->addFlash('exito', 'Cambios guardados con éxito');
                return $this->redirectToRoute('parte_listar');
            } catch (\Exception $e) {
                $this->addFlash('error', 'No se han podido guardar los cambios');
            }
        }
        return $this->render('parte/modificar.html.twig', [
            'parte' => $parte,
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/parte/eliminar/{id}", name="parte_eliminar", requirements={"id":"\d+"})
     */
    public function eliminarParte(Request $request, ParteRepository $parteRepository, Parte $parte): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_ADMIN');
        if ($request->request->has('confirmar')) {
            try {
                $parteRepository->eliminar($parte);
                $parteRepository->guardar();
                $this->addFlash('exito', 'Parte eliminado con éxito');
                return $this->redirectToRoute('parte_listar');
            } catch (\Exception $e) {
                $this->addFlash('error', '¡Ocurrió un error al eliminar el parte!');
            }
        }
        return $this->render('parte/eliminar.html.twig', [
            'parte' => $parte
        ]);
    }
}
