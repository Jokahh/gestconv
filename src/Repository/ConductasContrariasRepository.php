<?php

namespace App\Repository;

use App\Entity\ConductasContrarias;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ConductasContrarias>
 *
 * @method ConductasContrarias|null find($id, $lockMode = null, $lockVersion = null)
 * @method ConductasContrarias|null findOneBy(array $criteria, array $orderBy = null)
 * @method ConductasContrarias[]    findAll()
 * @method ConductasContrarias[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConductasContrariasRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ConductasContrarias::class);
    }

    public function nuevo(): ConductasContrarias
    {
        $conductasContrarias = new ConductasContrarias();
        $this->getEntityManager()->persist($conductasContrarias);
        return $conductasContrarias;
    }

    public function guardar()
    {
        $this->getEntityManager()->flush();
    }

    public function eliminar(ConductasContrarias $conductasContrarias): void
    {
        $this->getEntityManager()->remove($conductasContrarias);
    }
}
