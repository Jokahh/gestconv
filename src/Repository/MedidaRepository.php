<?php

namespace App\Repository;

use App\Entity\Medida;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Medida>
 *
 * @method Medida|null find($id, $lockMode = null, $lockVersion = null)
 * @method Medida|null findOneBy(array $criteria, array $orderBy = null)
 * @method Medida[]    findAll()
 * @method Medida[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MedidaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Medida::class);
    }

    public function findAllOrdenados(): array
    {
        return $this->createQueryBuilder('medida')
            ->orderBy('medida.orden', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function nuevo(): Medida
    {
        $medida = new Medida();
        $this->getEntityManager()->persist($medida);
        return $medida;
    }

    public function guardar()
    {
        $this->getEntityManager()->flush();
    }

    public function eliminar(Medida $medida): void
    {
        $this->getEntityManager()->remove($medida);
    }
}
