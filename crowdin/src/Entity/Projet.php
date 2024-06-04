<?php

namespace App\Entity;

use App\Repository\ProjetRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjetRepository::class)]
class Projet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $nomProjet = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: 'id_utilisateur', referencedColumnName: 'id')]
    private ?User $utilisateurCreateur = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $langueOrigine = null;

    #[ORM\Column(type: 'json')]
    private ?array $languesCibles = [];


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomProjet(): ?string
    {
        return $this->nomProjet;
    }

    public function setNomProjet(?string $nomProjet): self
    {
        $this->nomProjet = $nomProjet;

        return $this;
    }

    public function getUtilisateurCreateur(): ?User
    {
        return $this->utilisateurCreateur;
    }

    public function setUtilisateurCreateur(?User $utilisateurCreateur): self
    {
        $this->utilisateurCreateur = $utilisateurCreateur;

        return $this;
    }

    public function getLangueOrigine(): ?string
    {
        return $this->langueOrigine;
    }

    public function setLangueOrigine(?string $langueOrigine): self
    {
        $this->langueOrigine = $langueOrigine;

        return $this;
    }

    public function getLanguesCibles(): ?array
    {
        return $this->languesCibles;
    }

    public function setLanguesCibles(?array $languesCibles): self
    {
        $this->languesCibles = $languesCibles;

        return $this;
    }
}
