<?php

namespace App\Entity;

use App\Repository\ComunicacionParteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ComunicacionParteRepository::class)
 */
class ComunicacionParte extends Comunicacion
{
    /**
     * @ORM\ManyToOne(targetEntity=Parte::class, inversedBy="comunicacionParte")
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
