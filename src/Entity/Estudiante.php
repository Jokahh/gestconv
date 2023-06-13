<?php

namespace App\Entity;

use App\Repository\EstudianteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EstudianteRepository::class)
 */
class Estudiante
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=9, unique=true)
     */
    private $nie;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $apellido1;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $apellido2;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $telefono1;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $telefono2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $notaTelefono1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $notaTelefono2;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $tutor1;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $tutor2;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $fechaNacimiento;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $direccion;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $observaciones;

    /**
     * @ORM\ManyToMany(targetEntity=Grupo::class, mappedBy="estudiantes")
     */
    private $grupos;

    /**
     * @ORM\OneToMany(targetEntity=Parte::class, mappedBy="estudiante")
     */
    private $partes;

    public function __construct()
    {
        $this->grupos = new ArrayCollection();
        $this->partes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNie(): ?string
    {
        return $this->nie;
    }

    public function setNie(string $nie): self
    {
        $this->nie = $nie;

        return $this;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getApellido1(): ?string
    {
        return $this->apellido1;
    }

    public function setApellido1(string $apellido1): self
    {
        $this->apellido1 = $apellido1;

        return $this;
    }

    public function getApellido2(): ?string
    {
        return $this->apellido2;
    }

    public function setApellido2(?string $apellido2): self
    {
        $this->apellido2 = $apellido2;

        return $this;
    }

    public function getTelefono1(): ?string
    {
        return $this->telefono1;
    }

    public function setTelefono1(?string $telefono1): self
    {
        $this->telefono1 = $telefono1;

        return $this;
    }

    public function getTelefono2(): ?string
    {
        return $this->telefono2;
    }

    public function setTelefono2(?string $telefono2): self
    {
        $this->telefono2 = $telefono2;

        return $this;
    }

    public function getNotaTelefono1(): ?string
    {
        return $this->notaTelefono1;
    }

    public function setNotaTelefono1(?string $notaTelefono1): self
    {
        $this->notaTelefono1 = $notaTelefono1;

        return $this;
    }

    public function getNotaTelefono2(): ?string
    {
        return $this->notaTelefono2;
    }

    public function setNotaTelefono2(?string $notaTelefono2): self
    {
        $this->notaTelefono2 = $notaTelefono2;

        return $this;
    }

    public function getTutor1(): ?string
    {
        return $this->tutor1;
    }

    public function setTutor1(?string $tutor1): self
    {
        $this->tutor1 = $tutor1;

        return $this;
    }

    public function getTutor2(): ?string
    {
        return $this->tutor2;
    }

    public function setTutor2(?string $tutor2): self
    {
        $this->tutor2 = $tutor2;

        return $this;
    }

    public function getFechaNacimiento(): ?\DateTimeInterface
    {
        return $this->fechaNacimiento;
    }

    public function setFechaNacimiento(?\DateTimeInterface $fechaNacimiento): self
    {
        $this->fechaNacimiento = $fechaNacimiento;

        return $this;
    }

    public function getDireccion(): ?string
    {
        return $this->direccion;
    }

    public function setDireccion(?string $direccion): self
    {
        $this->direccion = $direccion;

        return $this;
    }

    public function getObservaciones(): ?string
    {
        return $this->observaciones;
    }

    public function setObservaciones(?string $observaciones): self
    {
        $this->observaciones = $observaciones;

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
            $grupo->addEstudiante($this);
        }

        return $this;
    }

    public function removeGrupo(Grupo $grupo): self
    {
        if ($this->grupos->removeElement($grupo)) {
            $grupo->removeEstudiante($this);
        }

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
            $parte->setEstudiante($this);
        }

        return $this;
    }

    public function removeParte(Parte $parte): self
    {
        if ($this->partes->removeElement($parte)) {
            // set the owning side to null (unless already changed)
            if ($parte->getEstudiante() === $this) {
                $parte->setEstudiante(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        $grupos = $this->getGrupos()->toArray();
        if (!empty($grupos)) {
            return $this->getApellido1() . ' ' . $this->getApellido2() . ' ' . $this->getNombre() . ' - ' . implode(', ', $grupos);
        }
        return $this->getApellido1() . ' ' . $this->getApellido2() . ' ' . $this->getNombre();
    }
}
