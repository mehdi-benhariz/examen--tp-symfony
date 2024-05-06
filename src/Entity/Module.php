<?php

namespace App\Entity;

use App\Repository\ModuleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ModuleRepository::class)]
class Module
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    public ?int $id = null;

    #[ORM\Column]
    public ?int $id_module = null;

    #[ORM\Column(length: 255)]
    public ?string $nom = null;

    #[ORM\Column(nullable: true)]
    public ?int $duree = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdModule(): ?int
    {
        return $this->id_module;
    }

    public function setIdModule(int $id_module): static
    {
        $this->id_module = $id_module;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(?int $duree): static
    {
        $this->duree = $duree;

        return $this;
    }
}
