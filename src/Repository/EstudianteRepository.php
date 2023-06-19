<?php

namespace App\Repository;

use App\Entity\Estudiante;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Estudiante>
 *
 * @method Estudiante|null find($id, $lockMode = null, $lockVersion = null)
 * @method Estudiante|null findOneBy(array $criteria, array $orderBy = null)
 * @method Estudiante[]    findAll()
 * @method Estudiante[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EstudianteRepository extends ServiceEntityRepository
{
    private $cursoAcademicoRepository;

    public function __construct(ManagerRegistry $registry, CursoAcademicoRepository $cursoAcademicoRepository)
    {
        parent::__construct($registry, Estudiante::class);
        $this->cursoAcademicoRepository = $cursoAcademicoRepository;
    }

    public function findAllEstudiantesDeGruposDelCursoActual(): array
    {
        $queryBuilder = $this->createQueryBuilder('estudiante');
        $queryBuilder
            ->join('estudiante.grupos', 'grupos')
            ->join('grupos.cursoAcademico', 'cursoAcademico')
            ->where('cursoAcademico.id = :cursoAcademicoId')
            ->setParameter('cursoAcademicoId', $this->cursoAcademicoRepository->findActivo()->getId());
        return $queryBuilder->getQuery()->getResult();
    }

    public function findAllEstudiantesDelDocenteDelCursoActual(int $id): array
    {
        $queryBuilder = $this->createQueryBuilder('estudiante');
        $queryBuilder
            ->join('estudiante.grupos', 'grupos')
            ->join('grupos.cursoAcademico', 'cursoAcademico')
            ->join('grupos.tutores','tutores')
            ->where('cursoAcademico.id = :cursoAcademicoId')
            ->andWhere('tutores.id = :tutor_id')
            ->setParameter('cursoAcademicoId', $this->cursoAcademicoRepository->findActivo()->getId())
            ->setParameter('tutor_id', $id);
        return $queryBuilder->getQuery()->getResult();
    }

    public function findAllEstudiantesDeGruposDelCursoActualSancionables(): array
    {
        $queryBuilder = $this->createQueryBuilder('estudiante');
        $queryBuilder
            ->join('estudiante.grupos', 'grupos')
            ->join('grupos.cursoAcademico', 'cursoAcademico')
            ->leftJoin('estudiante.partes', 'partes')
            ->where('cursoAcademico.id = :cursoAcademicoId')
            ->andWhere('partes.sancion IS NULL')
            ->andWhere('partes.prescrito = false')
            ->andWhere('partes.fechaAviso IS NOT NULL')
            ->orderBy('partes.fechaSuceso')
            ->setParameter('cursoAcademicoId', $this->cursoAcademicoRepository->findActivo()->getId());
        return $queryBuilder->getQuery()->getResult();
    }

    public function findAllEstudiantesDeGruposDelCursoActualNoNotificados(): array
    {
        $queryBuilder = $this->createQueryBuilder('estudiante');
        $queryBuilder
            ->join('estudiante.grupos', 'grupos')
            ->join('grupos.cursoAcademico', 'cursoAcademico')
            ->leftJoin('estudiante.partes', 'partes')
            ->where('cursoAcademico.id = :cursoAcademicoId')
            ->andWhere('partes.prescrito = false')
            ->andWhere('partes.fechaAviso IS NULL')
            ->orderBy('partes.fechaSuceso')
            ->setParameter('cursoAcademicoId', $this->cursoAcademicoRepository->findActivo()->getId());
        return $queryBuilder->getQuery()->getResult();
    }


    public function findAllEstudiantesDeGruposDelCursoActualConSancionesNoNotificadas(): array
    {
        $queryBuilder = $this->createQueryBuilder('estudiante');
        $queryBuilder
            ->join('estudiante.grupos', 'grupos')
            ->join('grupos.cursoAcademico', 'cursoAcademico')
            ->leftJoin('estudiante.partes', 'partes')
            ->join('partes.sancion', 'sancion')
            ->where('cursoAcademico.id = :cursoAcademicoId')
            ->andWhere('sancion.fechaComunicado IS NULL')
            ->orderBy('sancion.fechaSancion')
            ->setParameter('cursoAcademicoId', $this->cursoAcademicoRepository->findActivo()->getId());
        return $queryBuilder->getQuery()->getResult();
    }

    public function nuevo(): Estudiante
    {
        $estudiante = new Estudiante();
        $this->getEntityManager()->persist($estudiante);
        return $estudiante;
    }

    public function guardar()
    {
        $this->getEntityManager()->flush();
    }

    public function eliminar(Estudiante $estudiante): void
    {
        $this->getEntityManager()->remove($estudiante);
    }
}
