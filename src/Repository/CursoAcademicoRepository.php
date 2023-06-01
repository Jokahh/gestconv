<?php

namespace App\Repository;

use App\Entity\CursoAcademico;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CursoAcademico>
 *
 * @method CursoAcademico|null find($id, $lockMode = null, $lockVersion = null)
 * @method CursoAcademico|null findOneBy(array $criteria, array $orderBy = null)
 * @method CursoAcademico[]    findAll()
 * @method CursoAcademico[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CursoAcademicoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CursoAcademico::class);
    }

    public function nuevo(): CursoAcademico
    {
        $cursoAcademico = new CursoAcademico();
        $this->getEntityManager()->persist($cursoAcademico);
        return $cursoAcademico;
    }

    public function guardar()
    {
        $this->getEntityManager()->flush();
    }

    public function eliminar(CursoAcademico $cursoAcademico): void
    {
        $this->getEntityManager()->remove($cursoAcademico);
    }
}
