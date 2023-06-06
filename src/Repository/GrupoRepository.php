<?php

namespace App\Repository;

use App\Entity\Grupo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Grupo>
 *
 * @method Grupo|null find($id, $lockMode = null, $lockVersion = null)
 * @method Grupo|null findOneBy(array $criteria, array $orderBy = null)
 * @method Grupo[]    findAll()
 * @method Grupo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GrupoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Grupo::class);
    }


    public function findAllByCursoAcademicoId(int $cursoAcademicoId): array
    {
        return $this->createQueryBuilder('grupo')
            ->where('grupo.cursoAcademico = :curso_academico')
            ->setParameter('curso_academico', $cursoAcademicoId)
            ->getQuery()
            ->getResult();
    }

    public function nuevo(): Grupo
    {
        $grupo = new Grupo();
        $this->getEntityManager()->persist($grupo);
        return $grupo;
    }

    public function guardar()
    {
        $this->getEntityManager()->flush();
    }

    public function eliminar(Grupo $grupo): void
    {
        $this->getEntityManager()->remove($grupo);
    }
}
