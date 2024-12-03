<?php

namespace App\Entity;

use App\Repository\MatiereRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MatiereRepository::class)]
class Matiere
{
    
    #[ORM\Id]
    #[ORM\Column(length: 255)]
    private ?string $idmatiere = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $semestre = null;

    #[ORM\Column]
    private ?int $credit = null;

    

    public function getIdmatiere(): ?string
    {
        return $this->idmatiere;
    }

    public function setIdmatiere(string $idmatiere): static
    {
        $this->idmatiere = $idmatiere;

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

    public function getSemestre(): ?string
    {
        return $this->semestre;
    }

    public function setSemestre(string $semestre): static
    {
        $this->semestre = $semestre;

        return $this;
    }

    public function getCredit(): ?int
    {
        return $this->credit;
    }

    public function setCredit(int $credit): static
    {
        $this->credit = $credit;

        return $this;
    }
}
