<?php

namespace App\Entity;

use App\Repository\DocenteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=DocenteRepository::class)
 */
class Docente implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

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
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $telefono;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $notificaciones;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $esAdmin;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $estaActivo;


    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $esExterno;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $esDirectivo;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $esComisionario;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $usuario;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $password;

    /**
     * @ORM\ManyToMany(targetEntity=Grupo::class, mappedBy="tutores")
     */
    private $grupos;

    /**
     * @ORM\OneToMany(targetEntity=Parte::class, mappedBy="docente")
     */
    private $partes;

    /**
     * @ORM\ManyToMany(targetEntity=CursoAcademico::class, inversedBy="docentes")
     */
    private $cursosAcademicos;

    public function __construct()
    {
        $this->grupos = new ArrayCollection();
        $this->partes = new ArrayCollection();
        $this->cursosAcademicos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function setTelefono(?string $telefono): self
    {
        $this->telefono = $telefono;

        return $this;
    }

    public function getNotificaciones(): ?bool
    {
        return $this->notificaciones;
    }

    public function setNotificaciones(?bool $notificaciones): self
    {
        $this->notificaciones = $notificaciones;

        return $this;
    }

    public function getEsAdmin(): ?bool
    {
        return $this->esAdmin;
    }

    public function setEsAdmin(?bool $esAdmin): self
    {
        $this->esAdmin = $esAdmin;

        return $this;
    }

    public function getEstaActivo(): ?bool
    {
        return $this->estaActivo;
    }

    public function setEstaActivo(?bool $estaActivo): self
    {
        $this->estaActivo = $estaActivo;

        return $this;
    }


    public function getEsExterno(): ?bool
    {
        return $this->esExterno;
    }

    public function setEsExterno(?bool $esExterno): self
    {
        $this->esExterno = $esExterno;

        return $this;
    }

    public function getEsDirectivo(): ?bool
    {
        return $this->esDirectivo;
    }

    public function setEsDirectivo(?bool $esDirectivo): self
    {
        $this->esDirectivo = $esDirectivo;

        return $this;
    }

    public function getEsComisionario(): ?bool
    {
        return $this->esComisionario;
    }

    public function setEsComisionario(?bool $esComisionario): self
    {
        $this->esComisionario = $esComisionario;

        return $this;
    }

    public function getUsuario(): ?string
    {
        return $this->usuario;
    }

    public function setUsuario(?string $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): self
    {
        $this->password = $password;

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
            $grupo->addTutore($this);
        }

        return $this;
    }

    public function removeGrupo(Grupo $grupo): self
    {
        if ($this->grupos->removeElement($grupo)) {
            $grupo->removeTutore($this);
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
            $parte->setDocente($this);
        }

        return $this;
    }

    public function removeParte(Parte $parte): self
    {
        if ($this->partes->removeElement($parte)) {
            // set the owning side to null (unless already changed)
            if ($parte->getDocente() === $this) {
                $parte->setDocente(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getApellido1() . ' ' . $this->getApellido2() . ' ' . $this->getNombre();
    }

    public function getRoles(): array
    {
        $roles = ['ROLE_DOCENTE'];

        if ($this->getEsAdmin()) {
            $roles[] = 'ROLE_ADMIN';
        }
        if ($this->getEsComisionario()) {
            $roles[] = 'ROLE_COMISIONARIO';
        }
        if ($this->getEsDirectivo()) {
            $roles[] = 'ROLE_DIRECTIVO';
        }
        if ($this->getGrupos()) {
            $roles[] = 'ROLE_TUTOR';
        }

        // Si el Docente no está activo se le bloquea el acceso a la aplicación
        /*if (!$this->getEstaActivo()) {
            $roles = [];
        }*/

        return $roles;
    }

    public function getSalt()
    {
        return null;
    }

    public function getUsername(): ?string
    {
        return $this->getUsuario();
    }

    public function eraseCredentials()
    {
    }

    /**
     * @return Collection<int, CursoAcademico>
     */
    public function getCursosAcademicos(): Collection
    {
        return $this->cursosAcademicos;
    }

    public function addCursosAcademico(CursoAcademico $cursosAcademico): self
    {
        if (!$this->cursosAcademicos->contains($cursosAcademico)) {
            $this->cursosAcademicos[] = $cursosAcademico;
        }

        return $this;
    }

    public function removeCursosAcademico(CursoAcademico $cursosAcademico): self
    {
        $this->cursosAcademicos->removeElement($cursosAcademico);

        return $this;
    }

}
