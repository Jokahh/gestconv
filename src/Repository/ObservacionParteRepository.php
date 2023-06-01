<?php

namespace App\Repository;

use App\Entity\ObservacionParte;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ObservacionParte>
 *
 * @method ObservacionParte|null find($id, $lockMode = null, $lockVersion = null)
 * @method ObservacionParte|null findOneBy(array $criteria, array $orderBy = null)
 * @method ObservacionParte[]    findAll()
 * @method ObservacionParte[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ObservacionParteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ObservacionParte::class);
    }

    public function nuevo(): ObservacionParte
    {
        $observacionParte = new ObservacionParte();
        $this->getEntityManager()->persist($observacionParte);
        return $observacionParte;
    }

    public function guardar()
    {
        $this->getEntityManager()->flush();
    }

    public function eliminar(ObservacionParte $observacionParte): void
    {
        $this->getEntityManager()->remove($observacionParte);
    }
}
