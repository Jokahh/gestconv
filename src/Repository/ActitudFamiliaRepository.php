<?php

namespace App\Repository;

use App\Entity\ActitudFamilia;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ActitudFamilia>
 *
 * @method ActitudFamilia|null find($id, $lockMode = null, $lockVersion = null)
 * @method ActitudFamilia|null findOneBy(array $criteria, array $orderBy = null)
 * @method ActitudFamilia[]    findAll()
 * @method ActitudFamilia[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActitudFamiliaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ActitudFamilia::class);
    }

    public function findAllByCursoAcademicoId(int $cursoAcademicoId): array
    {
        return $this->createQueryBuilder('actitud_familia')
            ->where('actitud_familia.cursoAcademico = :curso_academico')
            ->setParameter('curso_academico', $cursoAcademicoId)
            ->orderBy('actitud_familia.orden', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function nuevo(): ActitudFamilia
    {
        $actitudFamilia = new ActitudFamilia();
        $this->getEntityManager()->persist($actitudFamilia);
        return $actitudFamilia;
    }

    public function guardar()
    {
        $this->getEntityManager()->flush();
    }

    public function eliminar(ActitudFamilia $actitudFamilia): void
    {
        $this->getEntityManager()->remove($actitudFamilia);
    }
}
