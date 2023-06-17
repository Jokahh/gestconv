<?php

namespace App\Entity;

use App\Repository\CursoAcademicoRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CursoAcademicoRepository::class)
 */
class CursoAcademico
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $descripcion;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $fechaInicio;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $fechaFin;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $estado;


    /**
     * @ORM\OneToMany(targetEntity=Grupo::class, mappedBy="cursoAcademico")
     */
    private $grupo;

    /**
     * @ORM\OneToMany(targetEntity=ActitudFamilia::class, mappedBy="cursoAcademico")
     */
    private $actitudFamilia;

    /**
     * @ORM\OneToMany(targetEntity=CategoriaConductaContraria::class, mappedBy="cursoAcademico")
     */
    private $categoriasConductaContraria;

    /**
     * @ORM\OneToMany(targetEntity=ActitudFamilia::class, mappedBy="cursoAcademico")
     */
    private $actitudesFamilia;

    /**
     * @ORM\OneToMany(targetEntity=Tramo::class, mappedBy="cursoAcademico")
     */
    private $tramos;

    /**
     * @ORM\OneToMany(targetEntity=Grupo::class, mappedBy="cursoAcademico")
     */
    private $grupos;

    /**
     * @ORM\OneToMany(targetEntity=TipoComunicacion::class, mappedBy="cursoAcademico")
     */
    private $tiposComunicacion;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $esActivo;

    /**
     * @ORM\ManyToMany(targetEntity=Docente::class, mappedBy="cursosAcademicos")
     */
    private $docentes;


    public function __construct()
    {
        $this->tramo = new ArrayCollection();
        $this->grupo = new ArrayCollection();
        $this->actitudFamilia = new ArrayCollection();
        $this->categoriasConductaContraria = new ArrayCollection();
        $this->actitudesFamilia = new ArrayCollection();
        $this->tramos = new ArrayCollection();
        $this->grupos = new ArrayCollection();
        $this->tiposComunicacion = new ArrayCollection();
        $this->docentes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getFechaInicio(): ?DateTimeInterface
    {
        return $this->fechaInicio;
    }

    public function setFechaInicio(?DateTimeInterface $fechaInicio): self
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    public function getFechaFin(): ?DateTimeInterface
    {
        return $this->fechaFin;
    }

    public function setFechaFin(?DateTimeInterface $fechaFin): self
    {
        $this->fechaFin = $fechaFin;

        return $this;
    }

    public function getEstado(): ?bool
    {
        return $this->estado;
    }

    public function setEstado(?bool $estado): self
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * @return Collection<int, CategoriaConductaContraria>
     */
    public function getCategoriasConductaContraria(): Collection
    {
        return $this->categoriasConductaContraria;
    }

    public function addCategoriasConductaContrarium(CategoriaConductaContraria $categoriasConductaContrarium): self
    {
        if (!$this->categoriasConductaContraria->contains($categoriasConductaContrarium)) {
            $this->categoriasConductaContraria[] = $categoriasConductaContrarium;
            $categoriasConductaContrarium->setCursoAcademico($this);
        }

        return $this;
    }

    public function removeCategoriasConductaContrarium(CategoriaConductaContraria $categoriasConductaContrarium): self
    {
        if ($this->categoriasConductaContraria->removeElement($categoriasConductaContrarium)) {
            // set the owning side to null (unless already changed)
            if ($categoriasConductaContrarium->getCursoAcademico() === $this) {
                $categoriasConductaContrarium->setCursoAcademico(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ActitudFamilia>
     */
    public function getActitudesFamilia(): Collection
    {
        return $this->actitudesFamilia;
    }

    public function addActitudesFamilium(ActitudFamilia $actitudesFamilium): self
    {
        if (!$this->actitudesFamilia->contains($actitudesFamilium)) {
            $this->actitudesFamilia[] = $actitudesFamilium;
            $actitudesFamilium->setCursoAcademico($this);
        }

        return $this;
    }

    public function removeActitudesFamilium(ActitudFamilia $actitudesFamilium): self
    {
        if ($this->actitudesFamilia->removeElement($actitudesFamilium)) {
            // set the owning side to null (unless already changed)
            if ($actitudesFamilium->getCursoAcademico() === $this) {
                $actitudesFamilium->setCursoAcademico(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Tramo>
     */
    public function getTramos(): Collection
    {
        return $this->tramos;
    }

    public function addTramo(Tramo $tramo): self
    {
        if (!$this->tramos->contains($tramo)) {
            $this->tramos[] = $tramo;
            $tramo->setCursoAcademico($this);
        }

        return $this;
    }

    public function removeTramo(Tramo $tramo): self
    {
        if ($this->tramos->removeElement($tramo)) {
            // set the owning side to null (unless already changed)
            if ($tramo->getCursoAcademico() === $this) {
                $tramo->setCursoAcademico(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Grupo>
     */
    public function getGrupos(): Collection
    {
        return $this->grupos;
    }

    public function addGrupo(Grupo $grupo): self
    {
        if (!$this->grupos->contains($grupo)) {
            $this->grupos[] = $grupo;
            $grupo->setCursoAcademico($this);
        }

        return $this;
    }

    public function removeGrupo(Grupo $grupo): self
    {
        if ($this->grupos->removeElement($grupo)) {
            // set the owning side to null (unless already changed)
            if ($grupo->getCursoAcademico() === $this) {
                $grupo->setCursoAcademico(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, TipoComunicacion>
     */
    public function getTiposComunicacion(): Collection
    {
        return $this->tiposComunicacion;
    }

    public function addTiposComunicacion(TipoComunicacion $tiposComunicacion): self
    {
        if (!$this->tiposComunicacion->contains($tiposComunicacion)) {
            $this->tiposComunicacion[] = $tiposComunicacion;
            $tiposComunicacion->setCursoAcademico($this);
        }

        return $this;
    }

    public function removeTiposComunicacion(TipoComunicacion $tiposComunicacion): self
    {
        if ($this->tiposComunicacion->removeElement($tiposComunicacion)) {
            // set the owning side to null (unless already changed)
            if ($tiposComunicacion->getCursoAcademico() === $this) {
                $tiposComunicacion->setCursoAcademico(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return ($this->getDescripcion() == null) ? $this->getId() : $this->getDescripcion();
    }

    public function getEsActivo(): ?bool
    {
        return $this->esActivo;
    }

    public function setEsActivo(?bool $esActivo): self
    {
        $this->esActivo = $esActivo;

        return $this;
    }

    /**
     * @return Collection<int, Docente>
     */
    public function getDocentes(): Collection
    {
        return $this->docentes;
    }

    public function addDocente(Docente $docente): self
    {
        if (!$this->docentes->contains($docente)) {
            $this->docentes[] = $docente;
            $docente->addCursosAcademico($this);
        }

        return $this;
    }

    public function removeDocente(Docente $docente): self
    {
        if ($this->docentes->removeElement($docente)) {
            $docente->removeCursosAcademico($this);
        }

        return $this;
    }

}
