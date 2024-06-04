<?php

namespace App\Entity;

use App\Repository\TraductionRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: TraductionRepository::class)]
class Traduction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'text',nullable: true)]
    private ?string $contenuTraduction = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: 'id_user', referencedColumnName: 'id')]
    private ?User $user = null;

    #[ORM\ManyToMany(targetEntity: Source::class)]
    private $sources;



    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: 'attribution_user_id', referencedColumnName: 'id')]
    private ?User $attributionUser = null;

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;
        return $this;
    }
    public function __construct()
    {
        $this->sources = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSources(): Collection
    {
        return $this->sources;
    }

    public function setSources(Collection $sources): self
    {
        $this->sources = $sources;
        return $this;
    }
    public function addSource(Source $source): self
    {
        if (!$this->sources->contains($source)) {
            $this->sources[] = $source;
        }

        return $this;
    }

    public function removeSource(Source $source): self
    {
        $this->sources->removeElement($source);

        return $this;
    }

    public function getContenuTraduction(): ?string
    {
        return $this->contenuTraduction;
    }

    public function setContenuTraduction(?string $contenuTraduction): self
    {
        $this->contenuTraduction = $contenuTraduction;
        return $this;
    }


    public function getAttributionUser(): ?User
    {
        return $this->attributionUser;
    }

    public function setAttributionUser(?User $attributionUser): self
    {
        $this->attributionUser = $attributionUser;
        return $this;
    }
}