<?php

namespace App\Entity;

use App\Repository\GladiatorRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GladiatorRepository::class)]
class Gladiator
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $avatar = null;

    #[ORM\Column(type: Types::FLOAT)]
    private ?float $address = null;

    #[ORM\Column(type: Types::FLOAT)]
    private ?float $strength = null;

    #[ORM\Column(type: Types::FLOAT)]
    private ?float $balance = null;

    #[ORM\Column(type: Types::FLOAT)]
    private ?float $speed = null;

    #[ORM\Column(type: Types::FLOAT)]
    private ?float $strategy = null;

    #[ORM\ManyToOne(inversedBy: 'gladiators')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Ludi $ludis = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $edit = null;

    #[ORM\Column(nullable: true)]
    private ?float $perfomance = null;

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

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    public function getAddress(): ?int
    {
        return $this->address;
    }

    public function setAddress(int $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getStrength(): ?int
    {
        return $this->strength;
    }

    public function setStrength(int $strength): self
    {
        $this->strength = $strength;

        return $this;
    }

    public function getBalance(): ?int
    {
        return $this->balance;
    }

    public function setBalance(int $balance): self
    {
        $this->balance = $balance;

        return $this;
    }

    public function getSpeed(): ?int
    {
        return $this->speed;
    }

    public function setSpeed(int $speed): self
    {
        $this->speed = $speed;

        return $this;
    }

    public function getStrategy(): ?int
    {
        return $this->strategy;
    }

    public function setStrategy(int $strategy): self
    {
        $this->strategy = $strategy;

        return $this;
    }

    public function getLudis(): ?Ludi
    {
        return $this->ludis;
    }

    public function setLudis(?Ludi $ludis): self
    {
        $this->ludis = $ludis;

        return $this;
    }

    public function getEdit(): ?\DateTimeInterface
    {
        return $this->edit;
    }

    public function setEdit(?\DateTimeInterface $edit): self
    {
        $this->edit = $edit;

        return $this;
    }

    public function getPerfomance(): ?float
    {
        return $this->perfomance;
    }

    public function setPerfomance(?float $perfomance): self
    {
        $this->perfomance = $perfomance;

        return $this;
    }
}
