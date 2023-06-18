<?php

namespace App\Entity;

use App\Repository\ConductaContrariaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ConductaContrariaRepository::class)
 */
class ConductaContraria
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
     * @ORM\ManyToOne(targetEntity=CategoriaConductaContraria::class, inversedBy="conductasContrarias")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categoria;

    /**
     * @ORM\ManyToOne(targetEntity=Parte::class, inversedBy="conductasContrarias")
     */
    private $parte;

    /**
     * @ORM\ManyToMany(targetEntity=Parte::class, mappedBy="conductasContrarias")
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

    public function getOrden(): ?int
    {
        return $this->orden;
    }

    public function setOrden(?int $orden): self
    {
        $this->orden = $orden;

        return $this;
    }


    public function getCategoria(): ?CategoriaConductaContraria
    {
        return $this->categoria;
    }

    public function setCategoria(?CategoriaConductaContraria $categoria): self
    {
        $this->categoria = $categoria;

        return $this;
    }

    public function __toString()
    {
        return '' . $this->getCategoria();
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
            $parte->addConductasContraria($this);
        }

        return $this;
    }

    public function removeParte(Parte $parte): self
    {
        if ($this->partes->removeElement($parte)) {
            $parte->removeConductasContraria($this);
        }

        return $this;
    }


}
