<?php

namespace Zuske\AuthClient\Security;

use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @method string getUserIdentifier()
 */
class Usuario implements UserInterface
{
    private int $id;
    private string $username;
    private string $email;
    private string $scope;

    public function getId(): int
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getRoles(): array
    {
        return [$this->scope];
    }

    public function getPassword(): null
    {
        return null;
    }

    public function getSalt(): null
    {
        return null;
    }

    public function eraseCredentials(): null
    {
        return null;
    }

    public function getUsername(): string
    {
        return $this->username;
    }
}