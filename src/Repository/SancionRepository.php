<?php

namespace App\Repository;

use App\Entity\Estudiante;
use App\Entity\Sancion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Sancion>
 *
 * @method Sancion|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sancion|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sancion[]    findAll()
 * @method Sancion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SancionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sancion::class);
    }

    public function findAllPorEstudiante(Estudiante $estudiante): array
    {
        $queryBuilder = $this->createQueryBuilder('sancion');
        $queryBuilder
            ->join('sancion.partes', 'partes')
            ->where('partes.estudiante = :estudiante')
            ->orderBy('sancion.fechaSancion')
            ->setParameter('estudiante', $estudiante);
        return $queryBuilder->getQuery()->getResult();
    }

    public function nuevo(): Sancion
    {
        $sancion = new Sancion();
        $this->getEntityManager()->persist($sancion);
        return $sancion;
    }

    public function guardar()
    {
        $this->getEntityManager()->flush();
    }

    public function eliminar(Sancion $sancion): void
    {
        $this->getEntityManager()->remove($sancion);
    }
}
