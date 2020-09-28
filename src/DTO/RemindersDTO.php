<?php

declare(strict_types=1);

namespace App\DTO;

use Assert\Assertion;
use Symfony\Component\Validator\Constraints as Assert;


final class RemindersDTO
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

    public static function fromRequest(array $request): self
    {
        Assertion::keyExists($request, 'login');
        Assertion::keyExists($request, 'name');
        Assertion::keyExists($request, 'surname');
        Assertion::keyExists($request, 'password');


        $self = new self();
        $self->login = $request['login'];
        $self->name = $request['name'];
        $self->surname = $request['surname'];
        $self->password = $request['password'];

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

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }
}
