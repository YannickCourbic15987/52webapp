<?php

namespace App\Entity;

use App\Repository\LudiRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: LudiRepository::class)]
class Ludi
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "le nom ne peut pas être vide.")]
    #[Assert\Length(
        min: 3,
        minMessage: 'le nom doit faire au moins 3 caractères.'
    )]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "le nom ne peut pas être vide.")]
    private ?string $speciality = null;

    #[ORM\ManyToOne(inversedBy: 'ludis')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Laniste $lanistes = null;

    #[ORM\OneToMany(mappedBy: 'ludis', targetEntity: Gladiator::class)]
    private Collection $gladiators;

    public function __construct()
    {
        $this->gladiators = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSpeciality(): ?string
    {
        return $this->speciality;
    }

    public function setSpeciality(string $speciality): self
    {
        $this->speciality = $speciality;

        return $this;
    }

    public function getLanistes(): ?Laniste
    {
        return $this->lanistes;
    }

    public function setLanistes(?Laniste $lanistes): self
    {
        $this->lanistes = $lanistes;

        return $this;
    }

    /**
     * @return Collection<int, Gladiator>
     */
    public function getGladiators(): Collection
    {
        return $this->gladiators;
    }

    public function addGladiator(Gladiator $gladiator): self
    {
        if (!$this->gladiators->contains($gladiator)) {
            $this->gladiators->add($gladiator);
            $gladiator->setLudis($this);
        }

        return $this;
    }

    public function removeGladiator(Gladiator $gladiator): self
    {
        if ($this->gladiators->removeElement($gladiator)) {
            // set the owning side to null (unless already changed)
            if ($gladiator->getLudis() === $this) {
                $gladiator->setLudis(null);
            }
        }

        return $this;
    }



}
