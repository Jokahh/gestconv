<?php

namespace App\Entity;

use App\Repository\MedidaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MedidaRepository::class)
 */
class Medida
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $dias;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $nombre;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $orden;

    /**
     * @ORM\ManyToMany(targetEntity=Sancion::class, mappedBy="medidas")
     */
    private $sanciones;

    /**
     * @ORM\ManyToOne(targetEntity=CategoriaMedida::class, inversedBy="medidas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categoria;

    public function __construct()
    {
        $this->sanciones = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDias(): ?int
    {
        return $this->dias;
    }

    public function setDias(?int $dias): self
    {
        $this->dias = $dias;

        return $this;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(?string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getOrden(): ?int
    {
        return $this->orden;
    }

    public function setOrden(?int $orden): self
    {
        $this->orden = $orden;

        return $this;
    }

    /**
     * @return Collection<int, Sancion>
     */
    public function getSanciones(): Collection
    {
        return $this->sanciones;
    }

    public function addSanciones(Sancion $sanciones): self
    {
        if (!$this->sanciones->contains($sanciones)) {
            $this->sanciones[] = $sanciones;
            $sanciones->addMedida($this);
        }

        return $this;
    }

    public function removeSanciones(Sancion $sanciones): self
    {
        if ($this->sanciones->removeElement($sanciones)) {
            $sanciones->removeMedida($this);
        }

        return $this;
    }

    public function getCategoria(): ?CategoriaMedida
    {
        return $this->categoria;
    }

    public function setCategoria(?CategoriaMedida $categoria): self
    {
        $this->categoria = $categoria;

        return $this;
    }
    public function __toString()
    {
        return ($this->getNombre() == null) ? $this->getId() : $this->getNombre();
    }
}
