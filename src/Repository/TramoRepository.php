<?php

namespace App\Repository;

use App\Entity\Tramo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Tramo>
 *
 * @method Tramo|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tramo|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tramo[]    findAll()
 * @method Tramo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TramoRepository extends ServiceEntityRepository
{
    private $cursoAcademicoRepository;

    public function __construct(ManagerRegistry $registry, CursoAcademicoRepository $cursoAcademicoRepository)
    {
        parent::__construct($registry, Tramo::class);
        $this->cursoAcademicoRepository = $cursoAcademicoRepository;
    }

    public function findAllByCursoActivo(): array
    {
        return $this->createQueryBuilder('tramo')
            ->where('tramo.cursoAcademico = :curso_academico')
            ->setParameter('curso_academico', $this->cursoAcademicoRepository->findActivo())
            ->orderBy('tramo.orden', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function nuevo(): Tramo
    {
        $tramo = new Tramo();
        $this->getEntityManager()->persist($tramo);
        return $tramo;
    }

    public function guardar()
    {
        $this->getEntityManager()->flush();
    }

    public function eliminar(Tramo $tramo): void
    {
        $this->getEntityManager()->remove($tramo);
    }
}
