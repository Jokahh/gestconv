<?php

namespace App\Entity;

use App\Repository\ConductasContrariasRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ConductasContrariasRepository::class)
 */
class ConductasContrarias
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
     * @ORM\ManyToOne(targetEntity=Parte::class, inversedBy="conductasContrarias")
     * @ORM\JoinColumn(nullable=false)
     */
    private $parte;

    /**
     * @ORM\ManyToOne(targetEntity=CategoriaConductaContraria::class, inversedBy="conductasContrarias")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categoria;

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

    public function getParte(): ?Parte
    {
        return $this->parte;
    }

    public function setParte(?Parte $parte): self
    {
        $this->parte = $parte;

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
}