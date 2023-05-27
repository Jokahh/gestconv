<?php

namespace App\Entity;

use App\Repository\TipoComunicacionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TipoComunicacionRepository::class)
 */
class TipoComunicacion
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
    private $descripcion;

    /**
     * @ORM\OneToMany(targetEntity=Comunicacion::class, mappedBy="tipo")
     */
    private $comunicaciones;

    /**
     * @ORM\ManyToOne(targetEntity=CursoAcademico::class, inversedBy="tiposComunicacion")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cursoAcademico;

    public function __construct()
    {
        $this->comunicaciones = new ArrayCollection();
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

    /**
     * @return Collection<int, Comunicacion>
     */
    public function getComunicaciones(): Collection
    {
        return $this->comunicaciones;
    }

    public function addComunicacion(Comunicacion $comunicacion): self
    {
        if (!$this->comunicaciones->contains($comunicacion)) {
            $this->comunicaciones[] = $comunicacion;
            $comunicacion->setTipo($this);
        }

        return $this;
    }

    public function removeComunicacion(Comunicacion $comunicacion): self
    {
        if ($this->comunicaciones->removeElement($comunicacion)) {
            // set the owning side to null (unless already changed)
            if ($comunicacion->getTipo() === $this) {
                $comunicacion->setTipo(null);
            }
        }

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

    public function __toString()
    {
        return $this->getDescripcion();
    }
}
