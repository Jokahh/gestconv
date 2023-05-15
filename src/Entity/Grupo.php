<?php

namespace App\Entity;

use App\Repository\GrupoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GrupoRepository::class)
 */
class Grupo
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
    private $nombre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $descripcion;

    /**
     * @ORM\ManyToOne(targetEntity=CursoAcademico::class, inversedBy="grupos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cursoAcademico;

    /**
     * @ORM\ManyToMany(targetEntity=Docente::class, inversedBy="grupos")
     */
    private $tutores;

    /**
     * @ORM\ManyToMany(targetEntity=Estudiante::class, inversedBy="grupos")
     */
    private $estudiantes;

    public function __construct()
    {
        $this->tutores = new ArrayCollection();
        $this->estudiantes = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
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

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): self
    {
        $this->descripcion = $descripcion;

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
     * @return Collection<int, Docente>
     */
    public function getTutores(): Collection
    {
        return $this->tutores;
    }

    public function addTutore(Docente $tutore): self
    {
        if (!$this->tutores->contains($tutore)) {
            $this->tutores[] = $tutore;
        }

        return $this;
    }

    public function removeTutore(Docente $tutore): self
    {
        $this->tutores->removeElement($tutore);

        return $this;
    }

    /**
     * @return Collection<int, Estudiante>
     */
    public function getEstudiantes(): Collection
    {
        return $this->estudiantes;
    }

    public function addEstudiante(Estudiante $estudiante): self
    {
        if (!$this->estudiantes->contains($estudiante)) {
            $this->estudiantes[] = $estudiante;
        }

        return $this;
    }

    public function removeEstudiante(Estudiante $estudiante): self
    {
        $this->estudiantes->removeElement($estudiante);

        return $this;
    }

}
