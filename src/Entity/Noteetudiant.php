<?php

namespace App\Entity;

use App\Repository\NoteEtudiantRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NoteEtudiantRepository::class)]
class NoteEtudiant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $idetudiant = null;

    #[ORM\Column(length: 255)]
    private ?string $idmatiere = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 0)]
    private ?string $note = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $session = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdetudiant(): ?string
    {
        return $this->idetudiant;
    }

    public function setIdetudiant(string $idEtudiant): static
    {
        $this->idetudiant = $idEtudiant;

        return $this;
    }

    public function getIdmatiere(): ?string
    {
        return $this->idmatiere;
    }

    public function setIdmatiere(string $idmatiere): static
    {
        $this->idmatiere = $idmatiere;

        return $this;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(string $note): static
    {
        $this->note = $note;

        return $this;
    }

    public function getSession(): ?\DateTimeInterface
    {
        return $this->session;
    }

    public function setSession(\DateTimeInterface $session): static
    {
        $this->session = $session;

        return $this;
    }
}
