<?php

declare(strict_types=1);

namespace App\DTO;

use Assert\Assertion;
use Symfony\Component\Validator\Constraints as Assert;

final class UserDTO
{
    /**
     * @Assert\NotBlank()
     * @Assert\Length(max="255")
     */
    private string $login;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(max="255")
     */
    private string $password;

    private array $roles;


    /**
     * @Assert\NotBlank()
     * @Assert\Length(max="255")
     */
    private string $name;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(max="255")
     */
    private string $surname;

    /**
     * @Assert\PositiveOrZero()
     */
    private int $active;

    private string $position;

    private string $telegram;

    /**
     * @Assert\Email()
     */
    private string $email;

    private string $phone;

    public static function fromRequest(array $request): self
    {
        Assertion::keyExists($request, 'login');
        Assertion::keyExists($request, 'password');
        Assertion::keyExists($request, 'roles');
        Assertion::keyExists($request, 'name');
        Assertion::keyExists($request, 'surname');
        Assertion::keyExists($request, 'email');
        Assertion::keyExists($request, 'phone');
        Assertion::keyExists($request, 'telegram');
        Assertion::keyExists($request, 'position');
        Assertion::keyExists($request, 'active');

        $self = new self();
        $self->login = $request['login'];
        $self->password = $request['password'];
        $self->roles = $request['roles'];
        $self->name = $request['name'];
        $self->surname = $request['surname'];
        $self->email = $request['email'];
        $self->phone = $request['phone'];
        $self->telegram = $request['telegram'];
        $self->position = $request['position'];
        $self->active = $request['active'];

        return $self;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function getActive(): int
    {
        return $this->active;
    }

    public function getPosition(): string
    {
        return $this->position;
    }

    public function getTelegram(): string
    {
        return $this->telegram;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }
}
