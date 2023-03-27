<?php

namespace App\Entity;

use App\Repository\LudisLanistesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LudisLanistesRepository::class)]
class LudisLanistes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'ludisLanistes')]
    private ?Ludi $ludi = null;

    #[ORM\OneToMany(mappedBy: 'ludisLanistes', targetEntity: laniste::class)]
    private Collection $laniste;

    public function __construct()
    {
        $this->laniste = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLudi(): ?Ludi
    {
        return $this->ludi;
    }

    public function setLudi(?Ludi $ludi): self
    {
        $this->ludi = $ludi;

        return $this;
    }

    /**
     * @return Collection<int, laniste>
     */
    public function getLaniste(): Collection
    {
        return $this->laniste;
    }

    public function addLaniste(laniste $laniste): self
    {
        if (!$this->laniste->contains($laniste)) {
            $this->laniste->add($laniste);
            $laniste->setLudisLanistes($this);
        }

        return $this;
    }

    public function removeLaniste(laniste $laniste): self
    {
        if ($this->laniste->removeElement($laniste)) {
            // set the owning side to null (unless already changed)
            if ($laniste->getLudisLanistes() === $this) {
                $laniste->setLudisLanistes(null);
            }
        }

        return $this;
    }
}
