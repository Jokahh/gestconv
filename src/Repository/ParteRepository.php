<?php

namespace App\Repository;

use App\Entity\Estudiante;
use App\Entity\Parte;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Parte>
 *
 * @method Parte|null find($id, $lockMode = null, $lockVersion = null)
 * @method Parte|null findOneBy(array $criteria, array $orderBy = null)
 * @method Parte[]    findAll()
 * @method Parte[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParteRepository extends ServiceEntityRepository
{
    private $cursoAcademicoRepository;
    public function __construct(ManagerRegistry $registry, CursoAcademicoRepository $cursoAcademicoRepository)
    {
        parent::__construct($registry, Parte::class);
        $this->cursoAcademicoRepository = $cursoAcademicoRepository;
    }

    public function findAllSancionablesPorEstudiante(Estudiante $estudiante): array
    {
        $queryBuilder = $this->createQueryBuilder('parte');
        $queryBuilder
            ->where('parte.estudiante = :estudiante')
            ->andWhere('parte.sancion IS NULL')
            ->andWhere('parte.prescrito = false')
            ->andWhere('parte.fechaAviso IS NOT NULL')
            ->orderBy('parte.fechaSuceso')
            ->setParameter('estudiante', $estudiante);
        return $queryBuilder->getQuery()->getResult();
    }

    public function findAllSancionablesDeEstudiantesDelCursoActual(): array
    {
        $queryBuilder = $this->createQueryBuilder('parte');
        $queryBuilder
            ->join('parte.estudiante', 'estudiante')
            ->join('estudiante.grupos', 'grupo')
            ->join('grupo.cursoAcademico', 'cursoAcademico')
            ->where('cursoAcademico.id = :cursoAcademicoId')
            ->andWhere('parte.sancion IS NULL')
            ->andWhere('parte.prescrito = false')
            ->andWhere('parte.fechaAviso IS NOT NULL')
            ->orderBy('parte.fechaSuceso')
            ->setParameter('cursoAcademicoId', $this->cursoAcademicoRepository->findActivo()->getId());
        return $queryBuilder->getQuery()->getResult();
    }

    public function findOneById(int $id)
    {
        $queryBuilder = $this->createQueryBuilder('parte');
        $queryBuilder
            ->where('parte.id = :id')
            ->setParameter('id', $id);
        return $queryBuilder->getQuery()->getResult();
    }

    public function nuevo(): Parte
    {
        $parte = new Parte();
        $this->getEntityManager()->persist($parte);
        return $parte;
    }

    public function guardar()
    {
        $this->getEntityManager()->flush();
    }

    public function eliminar(Parte $parte): void
    {
        $this->getEntityManager()->remove($parte);
    }
}
