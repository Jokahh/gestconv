<?php

namespace App\Repository;

use App\Entity\CategoriaConductaContraria;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CategoriaConductaContraria>
 *
 * @method CategoriaConductaContraria|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategoriaConductaContraria|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategoriaConductaContraria[]    findAll()
 * @method CategoriaConductaContraria[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoriaConductaContrariaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategoriaConductaContraria::class);
    }

    public function nuevo(): CategoriaConductaContraria
    {
        $categoriaConductaContraria = new CategoriaConductaContraria();
        $this->getEntityManager()->persist($categoriaConductaContraria);
        return $categoriaConductaContraria;
    }

    public function guardar()
    {
        $this->getEntityManager()->flush();
    }

    public function eliminar(CategoriaConductaContraria $categoriaConductaContraria): void
    {
        $this->getEntityManager()->remove($categoriaConductaContraria);
    }

}
