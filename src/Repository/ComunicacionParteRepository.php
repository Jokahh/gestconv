<?php

namespace App\Repository;

use App\Entity\ComunicacionParte;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ComunicacionParte>
 *
 * @method ComunicacionParte|null find($id, $lockMode = null, $lockVersion = null)
 * @method ComunicacionParte|null findOneBy(array $criteria, array $orderBy = null)
 * @method ComunicacionParte[]    findAll()
 * @method ComunicacionParte[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ComunicacionParteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ComunicacionParte::class);
    }

    public function nuevo(): ComunicacionParte
    {
        $comunicacionParte = new ComunicacionParte();
        $this->getEntityManager()->persist($comunicacionParte);
        return $comunicacionParte;
    }

    public function guardar()
    {
        $this->getEntityManager()->flush();
    }

    public function eliminar(ComunicacionParte $comunicacionParte): void
    {
        $this->getEntityManager()->remove($comunicacionParte);
    }
}
