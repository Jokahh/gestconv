<?php

namespace App\Entity;

use App\Repository\ObservacionParteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ObservacionParteRepository::class)
 */
class ObservacionParte extends Observacion
{
    /**
     * @ORM\ManyToOne(targetEntity=Parte::class, inversedBy="observaciones")
     * @ORM\JoinColumn(nullable=false)
     */
    private $parte;

    public function getParte(): ?Parte
    {
        return $this->parte;
    }

    public function setParte(?Parte $parte): self
    {
        $this->parte = $parte;

        return $this;
    }
}
