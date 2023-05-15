<?php

namespace App\Entity;

use App\Repository\CategoriaMedidaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoriaMedidaRepository::class)
 */
class CategoriaMedida
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
     * @ORM\OneToMany(targetEntity=Medida::class, mappedBy="categoria")
     */
    private $medidas;

    public function __construct()
    {
        $this->medidas = new ArrayCollection();
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
            $medida->setCategoria($this);
        }

        return $this;
    }

    public function removeMedida(Medida $medida): self
    {
        if ($this->medidas->removeElement($medida)) {
            // set the owning side to null (unless already changed)
            if ($medida->getCategoria() === $this) {
                $medida->setCategoria(null);
            }
        }

        return $this;
    }
}
