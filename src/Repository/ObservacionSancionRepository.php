<?php

namespace App\Repository;

use App\Entity\ObservacionSancion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ObservacionSancion>
 *
 * @method ObservacionSancion|null find($id, $lockMode = null, $lockVersion = null)
 * @method ObservacionSancion|null findOneBy(array $criteria, array $orderBy = null)
 * @method ObservacionSancion[]    findAll()
 * @method ObservacionSancion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ObservacionSancionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ObservacionSancion::class);
    }

    public function nuevo(): ObservacionSancion
    {
        $observacionSancion = new ObservacionSancion();
        $this->getEntityManager()->persist($observacionSancion);
        return $observacionSancion;
    }

    public function guardar()
    {
        $this->getEntityManager()->flush();
    }

    public function eliminar(ObservacionSancion $observacionSancion): void
    {
        $this->getEntityManager()->remove($observacionSancion);
    }
}
