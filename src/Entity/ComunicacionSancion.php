<?php

namespace App\Entity;

use App\Repository\ComunicacionSancionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ComunicacionSancionRepository::class)
 */
class ComunicacionSancion extends Comunicacion
{
    /**
     * @ORM\ManyToOne(targetEntity=Sancion::class, inversedBy="comunicaciones")
     * @ORM\JoinColumn(nullable=false)
     */
    private $sancion;

    public function getSancion(): ?Sancion
    {
        return $this->sancion;
    }

    public function setSancion(?Sancion $sancion): self
    {
        $this->sancion = $sancion;

        return $this;
    }
}
