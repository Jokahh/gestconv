<?php

namespace App\Entity;

use App\Repository\SancionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SancionRepository::class)
 */
class Sancion
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
    private $fechaSancion;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $fechaRegistroSalida;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $fechaComunicado;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $fechaInicioSancion;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $fechaFinSancion;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $anotacion;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $reclamacion;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $registradoEnSeneca;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $medidasEfectivas;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $motivosNoAplicacion;

    /**
     * @ORM\OneToMany(targetEntity=Parte::class, mappedBy="sancion")
     */
    private $partes;

    /**
     * @ORM\ManyToMany(targetEntity=Medida::class, inversedBy="sanciones")
     */
    private $medidas;

    /**
     * @ORM\ManyToOne(targetEntity=ActitudFamilia::class, inversedBy="sanciones")
     * @ORM\JoinColumn(nullable=false)
     */
    private $actitudFamilia;

    /**
     * @ORM\OneToMany(targetEntity=ObservacionSancion::class, mappedBy="sancion")
     */
    private $observaciones;

    /**
     * @ORM\OneToMany(targetEntity=ComunicacionSancion::class, mappedBy="sancion")
     */
    private $comunicaciones;


    public function __construct()
    {
        $this->partes = new ArrayCollection();
        $this->medidas = new ArrayCollection();
        $this->observaciones = new ArrayCollection();
        $this->comunicaciones = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFechaSancion(): ?\DateTimeInterface
    {
        return $this->fechaSancion;
    }

    public function setFechaSancion(?\DateTimeInterface $fechaSancion): self
    {
        $this->fechaSancion = $fechaSancion;

        return $this;
    }

    public function getFechaRegistroSalida(): ?\DateTimeInterface
    {
        return $this->fechaRegistroSalida;
    }

    public function setFechaRegistroSalida(?\DateTimeInterface $fechaRegistroSalida): self
    {
        $this->fechaRegistroSalida = $fechaRegistroSalida;

        return $this;
    }

    public function getFechaComunicado(): ?\DateTimeInterface
    {
        return $this->fechaComunicado;
    }

    public function setFechaComunicado(?\DateTimeInterface $fechaComunicado): self
    {
        $this->fechaComunicado = $fechaComunicado;

        return $this;
    }

    public function getFechaInicioSancion(): ?\DateTimeInterface
    {
        return $this->fechaInicioSancion;
    }

    public function setFechaInicioSancion(?\DateTimeInterface $fechaInicioSancion): self
    {
        $this->fechaInicioSancion = $fechaInicioSancion;

        return $this;
    }

    public function getFechaFinSancion(): ?\DateTimeInterface
    {
        return $this->fechaFinSancion;
    }

    public function setFechaFinSancion(?\DateTimeInterface $fechaFinSancion): self
    {
        $this->fechaFinSancion = $fechaFinSancion;

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

    public function getReclamacion(): ?bool
    {
        return $this->reclamacion;
    }

    public function setReclamacion(?bool $reclamacion): self
    {
        $this->reclamacion = $reclamacion;

        return $this;
    }

    public function getRegistradoEnSeneca(): ?bool
    {
        return $this->registradoEnSeneca;
    }

    public function setRegistradoEnSeneca(?bool $registradoEnSeneca): self
    {
        $this->registradoEnSeneca = $registradoEnSeneca;

        return $this;
    }

    public function getMedidasEfectivas(): ?bool
    {
        return $this->medidasEfectivas;
    }

    public function setMedidasEfectivas(?bool $medidasEfectivas): self
    {
        $this->medidasEfectivas = $medidasEfectivas;

        return $this;
    }

    public function getMotivosNoAplicacion(): ?string
    {
        return $this->motivosNoAplicacion;
    }

    public function setMotivosNoAplicacion(?string $motivosNoAplicacion): self
    {
        $this->motivosNoAplicacion = $motivosNoAplicacion;

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
            $parte->setSancion($this);
        }

        return $this;
    }

    public function removeParte(Parte $parte): self
    {
        if ($this->partes->removeElement($parte)) {
            // set the owning side to null (unless already changed)
            if ($parte->getSancion() === $this) {
                $parte->setSancion(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Medida>
     */
    public function getMedidas(): Collection
    {
        return $this->medidas;
    }

    public function addMedida(Medida $medida): self
    {
        if (!$this->medidas->contains($medida)) {
            $this->medidas[] = $medida;
        }

        return $this;
    }

    public function removeMedida(Medida $medida): self
    {
        $this->medidas->removeElement($medida);

        return $this;
    }

    public function getActitudFamilia(): ?ActitudFamilia
    {
        return $this->actitudFamilia;
    }

    public function setActitudFamilia(?ActitudFamilia $actitudFamilia): self
    {
        $this->actitudFamilia = $actitudFamilia;

        return $this;
    }

    /**
     * @return Collection<int, ObservacionSancion>
     */
    public function getObservaciones(): Collection
    {
        return $this->observaciones;
    }

    public function addObservacione(ObservacionSancion $observacione): self
    {
        if (!$this->observaciones->contains($observacione)) {
            $this->observaciones[] = $observacione;
            $observacione->setSancion($this);
        }

        return $this;
    }

    public function removeObservacione(ObservacionSancion $observacione): self
    {
        if ($this->observaciones->removeElement($observacione)) {
            // set the owning side to null (unless already changed)
            if ($observacione->getSancion() === $this) {
                $observacione->setSancion(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ComunicacionSancion>
     */
    public function getComunicaciones(): Collection
    {
        return $this->comunicaciones;
    }

    public function addComunicacione(ComunicacionSancion $comunicacione): self
    {
        if (!$this->comunicaciones->contains($comunicacione)) {
            $this->comunicaciones[] = $comunicacione;
            $comunicacione->setSancion($this);
        }

        return $this;
    }

    public function removeComunicacione(ComunicacionSancion $comunicacione): self
    {
        if ($this->comunicaciones->removeElement($comunicacione)) {
            // set the owning side to null (unless already changed)
            if ($comunicacione->getSancion() === $this) {
                $comunicacione->setSancion(null);
            }
        }

        return $this;
    }
}

