<?php

namespace App\Entity;

use App\Repository\ParteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ParteRepository::class)
 */
class Parte
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $fechaCreacion;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $fechaSuceso;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $fechaAviso;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $fechaRecordatorio;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $anotacion;

    /**
     * @ORM\Column(type="boolean")
     */
    private $prescrito;

    /**
     * @ORM\Column(type="boolean")
     */
    private $hayExpulsion;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $actividadesRealizadas;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $prioritaria;

    /**
     * @ORM\ManyToOne(targetEntity=Docente::class, inversedBy="partes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $docente;

    /**
     * @ORM\ManyToOne(targetEntity=Tramo::class, inversedBy="partes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $tramo;

    /**
     * @ORM\OneToMany(targetEntity=ConductaContraria::class, mappedBy="parte")
     */
    private $conductasContrarias;

    /**
     * @ORM\ManyToOne(targetEntity=Estudiante::class, inversedBy="partes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $estudiante;

    /**
     * @ORM\OneToMany(targetEntity=ComunicacionParte::class, mappedBy="parte")
     */
    private $comunicacionParte;

    /**
     * @ORM\ManyToOne(targetEntity=Sancion::class, inversedBy="partes")
     */
    private $sancion;

    /**
     * @ORM\OneToMany(targetEntity=ObservacionParte::class, mappedBy="parte")
     */
    private $observaciones;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $actividades;


    public function __construct()
    {
        $this->conductasContrarias = new ArrayCollection();
        $this->comunicacionParte = new ArrayCollection();
        $this->sanciones = new ArrayCollection();
        $this->observaciones = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFechaCreacion(): ?\DateTimeInterface
    {
        return $this->fechaCreacion;
    }

    public function setFechaCreacion(?\DateTimeInterface $fechaCreacion): self
    {
        $this->fechaCreacion = $fechaCreacion;

        return $this;
    }

    public function getFechaSuceso(): ?\DateTimeInterface
    {
        return $this->fechaSuceso;
    }

    public function setFechaSuceso(?\DateTimeInterface $fechaSuceso): self
    {
        $this->fechaSuceso = $fechaSuceso;

        return $this;
    }

    public function getFechaAviso(): ?\DateTimeInterface
    {
        return $this->fechaAviso;
    }

    public function setFechaAviso(?\DateTimeInterface $fechaAviso): self
    {
        $this->fechaAviso = $fechaAviso;

        return $this;
    }

    public function getFechaRecordatorio(): ?\DateTimeInterface
    {
        return $this->fechaRecordatorio;
    }

    public function setFechaRecordatorio(?\DateTimeInterface $fechaRecordatorio): self
    {
        $this->fechaRecordatorio = $fechaRecordatorio;

        return $this;
    }

    public function getAnotacion(): ?string
    {
        return $this->anotacion;
    }

    public function setAnotacion(string $anotacion): self
    {
        $this->anotacion = $anotacion;

        return $this;
    }

    public function getPrescrito(): ?bool
    {
        return $this->prescrito;
    }

    public function setPrescrito(bool $prescrito): self
    {
        $this->prescrito = $prescrito;

        return $this;
    }

    public function getHayExpulsion(): ?bool
    {
        return $this->hayExpulsion;
    }

    public function setHayExpulsion(bool $hayExpulsion): self
    {
        $this->hayExpulsion = $hayExpulsion;

        return $this;
    }

    public function getActividadesRealizadas(): ?bool
    {
        return $this->actividadesRealizadas;
    }

    public function setActividadesRealizadas(?bool $actividadesRealizadas): self
    {
        $this->actividadesRealizadas = $actividadesRealizadas;

        return $this;
    }

    public function getPrioritaria(): ?bool
    {
        return $this->prioritaria;
    }

    public function setPrioritaria(?bool $prioritaria): self
    {
        $this->prioritaria = $prioritaria;

        return $this;
    }

    public function getDocente(): ?Docente
    {
        return $this->docente;
    }

    public function setDocente(?Docente $docente): self
    {
        $this->docente = $docente;

        return $this;
    }

    public function getTramo(): ?Tramo
    {
        return $this->tramo;
    }

    public function setTramo(?Tramo $tramo): self
    {
        $this->tramo = $tramo;

        return $this;
    }

    /**
     * @return Collection<int, ConductaContraria>
     */
    public function getConductasContrarias(): Collection
    {
        return $this->conductasContrarias;
    }

    public function addConductaContraria(ConductaContraria $conductaContraria): self
    {
        if (!$this->conductasContrarias->contains($conductaContraria)) {
            $this->conductasContrarias[] = $conductaContraria;
            $conductaContraria->setParte($this);
        }

        return $this;
    }

    public function removeConductaContraria(ConductaContraria $conductaContraria): self
    {
        if ($this->conductasContrarias->removeElement($conductaContraria)) {
            // set the owning side to null (unless already changed)
            if ($conductaContraria->getParte() === $this) {
                $conductaContraria->setParte(null);
            }
        }

        return $this;
    }

    public function getEstudiante(): ?Estudiante
    {
        return $this->estudiante;
    }

    public function setEstudiante(?Estudiante $estudiante): self
    {
        $this->estudiante = $estudiante;

        return $this;
    }

    /**
     * @return Collection<int, ComunicacionParte>
     */
    public function getComunicacionParte(): Collection
    {
        return $this->comunicacionParte;
    }

    public function addComunicacionParte(ComunicacionParte $comunicacionParte): self
    {
        if (!$this->comunicacionParte->contains($comunicacionParte)) {
            $this->comunicacionParte[] = $comunicacionParte;
            $comunicacionParte->setParte($this);
        }

        return $this;
    }

    public function removeComunicacionParte(ComunicacionParte $comunicacionParte): self
    {
        if ($this->comunicacionParte->removeElement($comunicacionParte)) {
            // set the owning side to null (unless already changed)
            if ($comunicacionParte->getParte() === $this) {
                $comunicacionParte->setParte(null);
            }
        }

        return $this;
    }

    public function getSancion(): ?Sancion
    {
        return $this->sancion;
    }

    public function setSancion(?Sancion $sancion): self
    {
        $this->sancion = $sancion;

        return $this;
    }

    /**
     * @return Collection<int, ObservacionParte>
     */
    public function getObservaciones(): Collection
    {
        return $this->observaciones;
    }

    public function addObservacione(ObservacionParte $observacione): self
    {
        if (!$this->observaciones->contains($observacione)) {
            $this->observaciones[] = $observacione;
            $observacione->setParte($this);
        }

        return $this;
    }

    public function removeObservacione(ObservacionParte $observacione): self
    {
        if ($this->observaciones->removeElement($observacione)) {
            // set the owning side to null (unless already changed)
            if ($observacione->getParte() === $this) {
                $observacione->setParte(null);
            }
        }

        return $this;
    }

    public function getActividades(): ?string
    {
        return $this->actividades;
    }

    public function setActividades(?string $actividades): self
    {
        $this->actividades = $actividades;

        return $this;
    }

    public function __toString()
    {
        return ($this->getAnotacion() == null) ? $this->getId() : $this->getAnotacion();
    }
}
