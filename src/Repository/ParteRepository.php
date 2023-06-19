<?php

namespace App\Repository;

use App\Entity\ComunicacionParte;
use App\Entity\Docente;
use App\Entity\Estudiante;
use App\Entity\Parte;
use App\Entity\Sancion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\User\User;

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

    public function findAllByUsuarioId(int $id)
    {
        $queryBuilder = $this->createQueryBuilder('parte');
        $queryBuilder
            ->join('parte.docente', 'docente')
            ->where('docente.id = :id')
            ->setParameter('id', $id);
        return $queryBuilder->getQuery()->getResult();
    }


    public function findAllSancionadosPorEstudiante(Estudiante $estudiante): array
    {
        $queryBuilder = $this->createQueryBuilder('parte');
        $queryBuilder
            ->where('parte.estudiante = :estudiante')
            ->andWhere('parte.sancion IS NOT NULL')
            ->orderBy('parte.fechaSuceso')
            ->setParameter('estudiante', $estudiante);
        return $queryBuilder->getQuery()->getResult();
    }

    public function findPartePorSancion(Sancion $sancion): array
    {
        $queryBuilder = $this->createQueryBuilder('parte');
        $queryBuilder
            ->where('parte.sancion = :sancion')
            ->orderBy('parte.fechaSuceso')
            ->setParameter('sancion', $sancion);
        return $queryBuilder->getQuery()->getResult();
    }

    /**
     * @throws NonUniqueResultException
     */
    public function findPartePorComunicacion(ComunicacionParte $comunicacionParte): array
    {
        $queryBuilder = $this->createQueryBuilder('parte');
        $queryBuilder
            ->join('parte.comunicacionParte', 'comunicacion_parte')
            ->where('comunicacion_parte = :comunicacionParte')
            ->orderBy('parte.fechaSuceso')
            ->setParameter('comunicacionParte', $comunicacionParte);
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

    public function findNoNotificados()
    {
        $queryBuilder = $this->createQueryBuilder('parte');
        $queryBuilder
            ->innerJoin('parte.estudiante', 'estudiante')
            ->where('parte.fechaAviso IS NULL')
            ->orderBy('parte.fechaAviso');
        return $queryBuilder->getQuery()->getResult();
    }

    public function findNoNotificadosPorUsuario(User $user)
    {
        $queryBuilder = $this->createQueryBuilder('parte');
        $queryBuilder
            ->where('parte.docente = :user')
            ->andWhere('parte.fechaAviso IS NULL')
            ->orderBy('parte.fechaAviso')
            ->setParameter('user', $user);
        return $queryBuilder->getQuery()->getResult();
    }

    public function findNoNotificadosPorDocente(Docente $docente)
    {
        $queryBuilder = $this->createQueryBuilder('parte');
        $queryBuilder
            ->where('parte.docente = :docente')
            ->andWhere('parte.fechaAviso IS NULL')
            ->orderBy('parte.fechaAviso')
            ->setParameter('docente', $docente);
        return $queryBuilder->getQuery()->getResult();
    }

    public function findNoNotificadosPorEstudiante(Estudiante $estudiante)
    {
        $queryBuilder = $this->createQueryBuilder('parte');
        $queryBuilder
            ->where('parte.estudiante = :estudiante')
            ->andWhere('parte.fechaAviso IS NULL')
            ->orderBy('parte.fechaAviso')
            ->setParameter('estudiante', $estudiante);
        return $queryBuilder->getQuery()->getResult();
    }

    public function findNotificadosPorUsuario(User $user)
    {
        $queryBuilder = $this->createQueryBuilder('parte');
        $queryBuilder
            ->where('parte.docente = :user')
            ->andWhere('parte.fechaAviso IS NOT NULL')
            ->orderBy('parte.fechaAviso')
            ->setParameter('user', $user);
        return $queryBuilder->getQuery()->getResult();
    }

    public function findNotificados()
    {
        $queryBuilder = $this->createQueryBuilder('parte');
        $queryBuilder
            ->innerJoin('parte.estudiante', 'estudiante')
            ->where('parte.fechaAviso IS NOT NULL')
            ->orderBy('parte.fechaAviso');
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
