<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields:['username'], message: "Ce nom d'utilisaeur existe déjà.")]
class User implements  PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(
        min: 3,
        max: 50,
        minMessage: 'Le nom d\'utilisateur doit avoir plus de {{ limit }} caractères',
        maxMessage: 'Le nom d\'utilisateur doit avoir moins de {{ limit }}  caractères',
    )]
    private ?string $username = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(
        min: 3,
        max: 50,
        minMessage: 'Le mot de passe doit avoir plus de {{ limit }} caractères',
        maxMessage: 'Le mot de passe doit avoir moins de {{ limit }}  caractères',
    )]
    private ?string $password = null;

    #[Assert\EqualTo(propertyPath: "password", message: "Les mots de passe doivent être identiques")]
    private ?string $passwordConfirm = null;

    #[ORM\Column(length: 255)]
    private ?string $roles = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getPasswordConfirm(): ?string
    {
        return $this->passwordConfirm;
    }

    public function setPasswordConfirm(string $passwordConfirm): self
    {
        $this->passwordConfirm = $passwordConfirm;

        return $this;
    }

    public function getRoles(): ?string
    {
        return $this->roles;
    }

    public function setRoles(string $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getSalt(): ?string
    {
        return null;
    }

    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }

    public function hashPassword(PasswordAuthenticatedUserInterface $user, string $plainPassword): string
    {
        // TODO: Implement hashPassword() method.
    }

    public function isPasswordValid(PasswordAuthenticatedUserInterface $user, string $plainPassword): bool
    {
        // TODO: Implement isPasswordValid() method.
    }

    public function needsRehash(PasswordAuthenticatedUserInterface $user): bool
    {
        // TODO: Implement needsRehash() method.
    }
}
