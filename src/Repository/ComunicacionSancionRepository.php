<?php

namespace App\Repository;

use App\Entity\ComunicacionSancion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ComunicacionSancion>
 *
 * @method ComunicacionSancion|null find($id, $lockMode = null, $lockVersion = null)
 * @method ComunicacionSancion|null findOneBy(array $criteria, array $orderBy = null)
 * @method ComunicacionSancion[]    findAll()
 * @method ComunicacionSancion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ComunicacionSancionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ComunicacionSancion::class);
    }

    public function nuevo(): ComunicacionSancion
    {
        $comunicacionSancion = new ComunicacionSancion();
        $this->getEntityManager()->persist($comunicacionSancion);
        return $comunicacionSancion;
    }

    public function guardar()
    {
        $this->getEntityManager()->flush();
    }

    public function eliminar(ComunicacionSancion $comunicacionSancion): void
    {
        $this->getEntityManager()->remove($comunicacionSancion);
    }
}
