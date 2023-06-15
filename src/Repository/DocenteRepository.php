<?php

namespace App\Repository;

use App\Entity\Docente;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Docente>
 *
 * @method Docente|null find($id, $lockMode = null, $lockVersion = null)
 * @method Docente|null findOneBy(array $criteria, array $orderBy = null)
 * @method Docente[]    findAll()
 * @method Docente[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DocenteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Docente::class);
    }

    public function nuevo(): Docente
    {
        $docente = new Docente();
        $docente->setEstaActivo(true);
        $this->getEntityManager()->persist($docente);
        return $docente;
    }

    public function guardar()
    {
        $this->getEntityManager()->flush();
    }

    public function eliminar(Docente $docente): void
    {
        $this->getEntityManager()->remove($docente);
    }
}
