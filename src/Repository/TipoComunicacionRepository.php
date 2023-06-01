<?php

namespace App\Repository;

use App\Entity\TipoComunicacion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TipoComunicacion>
 *
 * @method TipoComunicacion|null find($id, $lockMode = null, $lockVersion = null)
 * @method TipoComunicacion|null findOneBy(array $criteria, array $orderBy = null)
 * @method TipoComunicacion[]    findAll()
 * @method TipoComunicacion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TipoComunicacionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TipoComunicacion::class);
    }

    public function nuevo(): TipoComunicacion
    {
        $tipoComunicacion = new TipoComunicacion();
        $this->getEntityManager()->persist($tipoComunicacion);
        return $tipoComunicacion;
    }

    public function guardar()
    {
        $this->getEntityManager()->flush();
    }

    public function eliminar(TipoComunicacion $tipoComunicacion): void
    {
        $this->getEntityManager()->remove($tipoComunicacion);
    }
}
