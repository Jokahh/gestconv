<?php

namespace App\Entity;

use App\Repository\CategoriaConductaContrariaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoriaConductaContrariaRepository::class)
 */
class CategoriaConductaContraria
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $descripcion;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $prioritaria;

    /**
     * @ORM\ManyToOne(targetEntity=CursoAcademico::class, inversedBy="categoriasConductaContraria")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cursoAcademico;

    /**
     * @ORM\OneToMany(targetEntity=ConductaContraria::class, mappedBy="categoria")
     */
    private $conductasContrarias;

    public function __construct()
    {
        $this->conductasContrarias = new ArrayCollection();
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

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): self
    {
        $this->descripcion = $descripcion;

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
     * @return Collection<int, ConductaContraria>
     */
    public function getConductasContrarias(): Collection
    {
        return $this->conductasContrarias;
    }

    public function addConductasContraria(ConductaContraria $conductaContraria): self
    {
        if (!$this->conductasContrarias->contains($conductaContraria)) {
            $this->conductasContrarias[] = $conductaContraria;
            $conductaContraria->setCategoria($this);
        }

        return $this;
    }

    public function removeConductasContraria(ConductaContraria $conductasContraria): self
    {
        if ($this->conductasContrarias->removeElement($conductasContraria)) {
            // set the owning side to null (unless already changed)
            if ($conductasContraria->getCategoria() === $this) {
                $conductasContraria->setCategoria(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->getDescripcion();
    }
}
