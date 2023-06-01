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
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tramo::class);
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
