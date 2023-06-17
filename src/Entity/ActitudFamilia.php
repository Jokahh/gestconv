<?php

namespace App\Entity;

use App\Repository\ActitudFamiliaRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ActitudFamiliaRepository::class)
 */
class ActitudFamilia
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
    private $orden;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $descripcion;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $fecha;

    /**
     * @ORM\ManyToOne(targetEntity=CursoAcademico::class, inversedBy="actitudesFamilia")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cursoAcademico;

    /**
     * @ORM\OneToMany(targetEntity=Sancion::class, mappedBy="actitudFamilia")
     */
    private $sanciones;

    public function __construct()
    {
        $this->sanciones = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
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

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getFecha(): ?DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(?DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getCursoAcademico(): ?CursoAcademico
    {
        return $this->cursoAcademico;
    }

    public function setCursoAcademico(?CursoAcademico $cursoAcademico): self
    {
        $this->cursoAcademico = $cursoAcademico;

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
            $sanciones->setActitudFamilia($this);
        }

        return $this;
    }

    public function removeSanciones(Sancion $sanciones): self
    {
        if ($this->sanciones->removeElement($sanciones)) {
            // set the owning side to null (unless already changed)
            if ($sanciones->getActitudFamilia() === $this) {
                $sanciones->setActitudFamilia(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return ($this->getDescripcion() == null) ? $this->getId() : $this->getDescripcion();
    }
}
