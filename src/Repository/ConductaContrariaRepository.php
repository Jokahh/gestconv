<?php

namespace App\Repository;

use App\Entity\ConductaContraria;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ConductaContraria>
 *
 * @method ConductaContraria|null find($id, $lockMode = null, $lockVersion = null)
 * @method ConductaContraria|null findOneBy(array $criteria, array $orderBy = null)
 * @method ConductaContraria[]    findAll()
 * @method ConductaContraria[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConductaContrariaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ConductaContraria::class);
    }

    public function findAllOrdenados(): array
    {
        return $this->createQueryBuilder('conducta_contraria')
            ->orderBy('conducta_contraria.orden', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function nuevo(): ConductaContraria
    {
        $conductaContraria = new ConductaContraria();
        $this->getEntityManager()->persist($conductaContraria);
        return $conductaContraria;
    }

    public function guardar()
    {
        $this->getEntityManager()->flush();
    }

    public function eliminar(ConductaContraria $conductaContraria): void
    {
        $this->getEntityManager()->remove($conductaContraria);
    }
}
