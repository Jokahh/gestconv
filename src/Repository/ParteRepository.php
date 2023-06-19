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
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Parte::class);
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
