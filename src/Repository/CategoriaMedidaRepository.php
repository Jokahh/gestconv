<?php

namespace App\Repository;

use App\Entity\CategoriaMedida;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CategoriaMedida>
 *
 * @method CategoriaMedida|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategoriaMedida|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategoriaMedida[]    findAll()
 * @method CategoriaMedida[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoriaMedidaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategoriaMedida::class);
    }

    public function findAllOrdenados(): array
    {
        return $this->createQueryBuilder('categoria_medida')
            ->orderBy('categoria_medida.orden', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function nuevo(): CategoriaMedida
    {
        $categoriaMedida = new CategoriaMedida();
        $this->getEntityManager()->persist($categoriaMedida);
        return $categoriaMedida;
    }

    public function guardar()
    {
        $this->getEntityManager()->flush();
    }

    public function eliminar(CategoriaMedida $categoriaMedida): void
    {
        $this->getEntityManager()->remove($categoriaMedida);
    }
}
