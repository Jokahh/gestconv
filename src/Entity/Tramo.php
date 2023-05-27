<?php

namespace App\Entity;

use App\Repository\TramoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TramoRepository::class)
 */
class Tramo
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $orden;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $diaSemana;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $horaInicio;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $horaFin;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $aula;

    /**
     * @ORM\ManyToOne(targetEntity=CursoAcademico::class, inversedBy="tramos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cursoAcademico;

    /**
     * @ORM\OneToMany(targetEntity=Parte::class, mappedBy="tramo")
     */
    private $partes;

    public function __construct()
    {
        $this->partes = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrden(): ?string
    {
        return $this->orden;
    }

    public function setOrden(?string $orden): self
    {
        $this->orden = $orden;

        return $this;
    }

    public function getDiaSemana(): ?string
    {
        return $this->diaSemana;
    }

    public function setDiaSemana(?string $diaSemana): self
    {
        $this->diaSemana = $diaSemana;

        return $this;
    }

    public function getHoraInicio(): ?string
    {
        return $this->horaInicio;
    }

    public function setHoraInicio(?string $horaInicio): self
    {
        $this->horaInicio = $horaInicio;

        return $this;
    }

    public function getHoraFin(): ?string
    {
        return $this->horaFin;
    }

    public function setHoraFin(?string $horaFin): self
    {
        $this->horaFin = $horaFin;

        return $this;
    }

    public function getAula(): ?string
    {
        return $this->aula;
    }

    public function setAula(?string $aula): self
    {
        $this->aula = $aula;

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
     * @return Collection<int, Parte>
     */
    public function getPartes(): Collection
    {
        return $this->partes;
    }

    public function addParte(Parte $parte): self
    {
        if (!$this->partes->contains($parte)) {
            $this->partes[] = $parte;
            $parte->setTramo($this);
        }

        return $this;
    }

    public function removeParte(Parte $parte): self
    {
        if ($this->partes->removeElement($parte)) {
            // set the owning side to null (unless already changed)
            if ($parte->getTramo() === $this) {
                $parte->setTramo(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return 'ID: ' . $this->getId();
    }

}
