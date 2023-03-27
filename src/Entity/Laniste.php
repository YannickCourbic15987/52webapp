<?php

namespace App\Entity;

use App\Repository\LanisteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;



#[ORM\Entity(repositoryClass: LanisteRepository::class)]
class Laniste implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];
    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    #[Assert\Regex(
        pattern: "^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$^",
        match: true,
        message: 'Minimum huit caractères, au moins une lettre, un chiffre et un caractère spécial.'
    )]
    #[Assert\NotBlank(message: "le mot de passe ne peut être vide.")]
    private ?string $password = null;

    #[ORM\Column(length: 150)]
    #[Assert\NotBlank(message: "le nom ne peut pas être vide.")]
    #[Assert\Length(
        min: 3,
        minMessage: 'le nom doit faire au moins 3 caractères.'
    )]
    private ?string $name = null;

    #[ORM\Column(length: 150)]
    #[Assert\Length(
        min: 3,
        minMessage: 'le prénom doit faire au moins 3 caractères.'
    )]
    #[Assert\NotBlank(message: "le prénom ne peut pas être vide.")]
    private ?string $prename = null;

    #[ORM\Column]
    #[Assert\PositiveOrZero(message: "la monnaie du jeu ne peut être négatif")]
    private ?int $coin = null;

    #[ORM\OneToMany(mappedBy: 'lanistes', targetEntity: Ludi::class)]
    private Collection $ludis;

    public function __construct()
    {
        $this->ludis = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getPrename(): ?string
    {
        return $this->prename;
    }

    public function setPrename(string $prename): self
    {
        $this->prename = $prename;

        return $this;
    }

    public function getCoin(): ?int
    {
        return $this->coin;
    }

    public function setCoin(int $coin): self
    {
        $this->coin = $coin;

        return $this;
    }

    /**
     * @return Collection<int, Ludi>
     */
    public function getLudis(): Collection
    {
        return $this->ludis;
    }

    public function addLudi(Ludi $ludi): self
    {
        if (!$this->ludis->contains($ludi)) {
            $this->ludis->add($ludi);
            $ludi->setLanistes($this);
        }

        return $this;
    }

    public function removeLudi(Ludi $ludi): self
    {
        if ($this->ludis->removeElement($ludi)) {
            // set the owning side to null (unless already changed)
            if ($ludi->getLanistes() === $this) {
                $ludi->setLanistes(null);
            }
        }

        return $this;
    }


}
