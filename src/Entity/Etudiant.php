<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\EtudiantRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtudiantRepository::class)]
#[ApiResource(
    collectionOperations={"get"},
    itemOperations={"get","post","delete","put"}
)]
class Etudiant
{
   
    #[ORM\Id]
    #[ORM\Column(length: 255)]
    #[Groups(['etudiant.read'])]
    private ?string $idetudiant = null;

    #[ORM\Column(length: 255)]
    #[Groups(['etudiant.read'])]
    private ?string $nom = null;

    

    public function getIdetudiant(): ?string
    {
        return $this->idetudiant;
    }

    public function setIdetudiant(string $idetudiant): static
    {
        $this->idetudiant = $idetudiant;

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
}
