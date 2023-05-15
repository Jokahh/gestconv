<?php

namespace App\Entity;

use App\Repository\ObservacionSancionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ObservacionSancionRepository::class)
 */
class ObservacionSancion extends Observacion
{
    /**
     * @ORM\ManyToOne(targetEntity=Sancion::class, inversedBy="observaciones")
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
