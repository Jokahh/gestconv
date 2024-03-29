<?php

namespace App\Controller;

use App\Entity\Docente;
use App\Form\CambiarPasswordDocenteType;
use App\Form\DocenteType;
use App\Repository\DocenteRepository;
use Exception;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class DocenteController extends AbstractController
{
    /**
     * @Route("/docente", name="docente_listar")
     */
    public function listar(DocenteRepository $docenteRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $this->denyAccessUnlessGranted('ROLE_DIRECTIVO');
        $pagination = $paginator->paginate(
            $docenteRepository->findAll(), /* Query - NO EL RESULTADO DE LA QUERY */
            $request->query->getInt('page', 1), /* Número de la página */
            10 /* Límite por página */
        );
        return $this->render('docente/listar.html.twig', [
            'pagination' => $pagination,
        ]);
    }

    /**
     * @Route ("/docente/nuevo", name="docente_nuevo")
     */
    public function nuevoDocente(Request $request, DocenteRepository $docenteRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_DIRECTIVO');
        $docente = $docenteRepository->nuevo();

        return $this->modificarDocente($request, $docenteRepository, $docente);
    }

    /**
     * @Route("/docente/{id}", name="docente_modificar", requirements={"id":"\d+"})
     */
    public function modificarDocente(Request $request, DocenteRepository $docenteRepository, Docente $docente): Response
    {
        if ($this->getUser()->getRoles() == $docente->getRoles()) {
            $this->denyAccessUnlessGranted('ROLE_DOCENTE');
        } else {
            $this->denyAccessUnlessGranted('ROLE_DIRECTIVO');
        }

        $form = $this->createForm(DocenteType::class, $docente, [
            'admin' => $this->isGranted('ROLE_DIRECTIVO'),
            'datosPropios' => $this->getUser()->getId() === $docente->getId()
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $docenteRepository->guardar();
                $this->addFlash('exito', 'Cambios guardados con éxito');
                return $this->redirectToRoute('docente_listar');
            } catch (Exception $e) {
                $this->addFlash('error', 'No se han podido guardar los cambios');
            }
        }
        return $this->render('docente/modificar.html.twig', [
            'docente' => $docente,
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/docente/eliminar/{id}", name="docente_eliminar", requirements={"id":"\d+"})
     */
    public function eliminarDocente(Request $request, DocenteRepository $docenteRepository, Docente $docente): Response
    {
        if ($docente->getId() == $this->getUser()->getId()) {
            throw $this->createAccessDeniedException('No puedes borrarte a tí mismo');
        }
        $this->denyAccessUnlessGranted('ROLE_DIRECTIVO');
        if ($request->request->has('confirmar')) {
            try {
                $docenteRepository->eliminar($docente);
                $docenteRepository->guardar();
                $this->addFlash('exito', 'Docente eliminado con éxito');
                return $this->redirectToRoute('docente_listar');
            } catch (Exception $e) {
                $this->addFlash('error', '¡Ocurrió un error al eliminar el docente!');
            }
        }
        return $this->render('docente/eliminar.html.twig', [
            'docente' => $docente
        ]);
    }

    /**
     * @Route("/docente/clave/{id}", name="docente_cambiar_clave", requirements={"id":"\d+"})
     */
    public function cambiarPasswordDocente(Request $request, UserPasswordEncoderInterface $passwordEncoder, DocenteRepository $docenteRepository, Docente $docente): Response
    {
        if ($this->getUser()->getRoles() == $docente->getRoles()) {
            $this->denyAccessUnlessGranted('ROLE_DOCENTE');
        } else {
            $this->denyAccessUnlessGranted('ROLE_DIRECTIVO');
        }

        $form = $this->createForm(CambiarPasswordDocenteType::class, $docente, [
            'admin' => $this->isGranted('ROLE_DIRECTIVO')
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $this->getUser()->setPassword(
                    $passwordEncoder->encodePassword(
                        $docente, $form->get('nuevaClave')->get('first')->getData()
                    )
                );
                $docenteRepository->guardar();
                $this->addFlash('exito', 'Cambios guardados con éxito');
                return $this->redirectToRoute('inicio');
            } catch (Exception $e) {
                $this->addFlash('error', 'No se han podido guardar los cambios');
            }
        }
        if (!$this->isGranted('ROLE_DIRECTIVO')) {
            $docente = $this->getUser();
        }
        return $this->render('security/cambiarClave.html.twig', [
            'docente' => $docente,
            'form' => $form->createView()
        ]);
    }
}
