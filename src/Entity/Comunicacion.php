<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\MappedSuperclass;

/**
 * @MappedSuperclass
 */
class Comunicacion
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $fecha;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $anotacion;

    /**
     * @ORM\ManyToOne(targetEntity=TipoComunicacion::class, inversedBy="comunicaciones")
     */
    private $tipo;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(?\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getAnotacion(): ?string
    {
        return $this->anotacion;
    }

    public function setAnotacion(?string $anotacion): self
    {
        $this->anotacion = $anotacion;

        return $this;
    }

    public function getTipo(): ?TipoComunicacion
    {
        return $this->tipo;
    }

    public function setTipo(?TipoComunicacion $tipo): self
    {
        $this->tipo = $tipo;

        return $this;
    }
    public function __toString()
    {
        return $this->getAnotacion();
    }
}
